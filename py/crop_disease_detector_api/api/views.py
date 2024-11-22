from django.http import JsonResponse, HttpResponse
from django.views.decorators.csrf import csrf_exempt
import numpy as np
import tensorflow as tf  # Using TensorFlow for TFLite
from PIL import Image
import json
import os
import logging

# Set up logging
logger = logging.getLogger(__name__)

# Load the TensorFlow Lite model
try:
    interpreter = tf.lite.Interpreter(model_path=os.path.join(os.path.dirname(__file__), '..', 'model.tflite'))
    interpreter.allocate_tensors()
except Exception as e:
    logger.error("Error loading model: %s", e)

# Load the diseases dataset
try:
    with open(os.path.join(os.path.dirname(__file__), '..', 'diseases.json')) as f:
        diseases_data = json.load(f)
except Exception as e:
    logger.error("Error loading diseases data: %s", e)
    diseases_data = {"diseases": []}  # Fallback to empty data

def home(request):
    return HttpResponse("<h1>Welcome to the Crop Disease Detector!</h1>")

@csrf_exempt  # To allow POST requests without CSRF token
def predict(request):
    if request.method == 'POST' and 'file' in request.FILES:
        file = request.FILES['file']
        try:
            # Open and preprocess the image
            image = Image.open(file).convert("RGB")
            image = image.resize((224, 224))  # Resize to match model input size
            image_array = np.array(image) / 255.0  # Normalize the image
            image_array = np.expand_dims(image_array, axis=0)  # Add batch dimension

            # Set up input and output tensors
            input_details = interpreter.get_input_details()
            output_details = interpreter.get_output_details()
            
            # Ensure input shape matches model input
            interpreter.set_tensor(input_details[0]['index'], image_array.astype(np.float32))
            interpreter.invoke()
            predictions = interpreter.get_tensor(output_details[0]['index'])

            predicted_class = np.argmax(predictions, axis=1)[0]

            # Define class labels
            classes = ["Healthy", "NotPlant", "Powdery", "Rust"]
            result = classes[predicted_class]
            disease_info = next((disease for disease in diseases_data["diseases"] if disease["name"] == result), None)

            return JsonResponse({"status": "success", "prediction": result, "info": disease_info})
        except Exception as e:
            logger.error("Error processing the image: %s", e)
            return JsonResponse({"status": "error", "message": "Error processing the image: " + str(e)}, status=500)
    
    return JsonResponse({"status": "error", "message": "Invalid request"}, status=400)
