from firebase_functions import https_fn
from firebase_admin import initialize_app
import requests
import json

# Initialize Firebase Admin SDK
initialize_app()

@https_fn.on_request()
def predict(req: https_fn.Request) -> https_fn.Response:
    # Check if the request method is POST
    if req.method != 'POST':
        return https_fn.Response("Method not allowed", status_code=405)
    
    # Get the JSON data from the request
    data = req.get_json()
    
    # Forward the data to your Django API
    django_url = "https://mrcrop.wuaze.com/api/predict/"  # Your Django API URL
    try:
        # Send a POST request to the Django API
        response = requests.post(django_url, json=data)
        
        # Return the response from the Django API back to the client
        return https_fn.Response(response.text, status_code=response.status_code)
    
    except Exception as e:
        return https_fn.Response(f"Error: {str(e)}", status_code=500)