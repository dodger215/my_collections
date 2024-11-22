from flask import Flask, Response, render_template
import cv2

app = Flask(__name__)

cap = cv2.VideoCapture(0)


#####################################################################################
#####
#####    By Kelvin Enos-Dzah
#####    Models: haarcascade_frontalface
#####
#####
#####################################################################################
face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
eye_cascade = cv2.CascadeClassifier('haarcascade_eye.xml')

bg_sub = cv2.createBackgroundSubtractorKNN()

def generate_frames():
    while True:
        ret, frame = cap.read()
        if not ret:
            break

        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        invert_gray = cv2.bitwise_not(gray)
        blur = cv2.GaussianBlur(invert_gray, (21, 21), 0)
        invertblur = cv2.bitwise_not(blur)
        sketch = cv2.divide(gray, invertblur, scale=256.0)

        faces = face_cascade.detectMultiScale(gray, 1.3, 5)
        for (x, y, w, h) in faces:
            cv2.rectangle(frame, (x, y), (x+w, y+h), (255, 0, 0), 2)
            roi_gray = gray[y:y+h, x:x+w]
            roi_color = frame[y:y+h, x:x+w]
            eyes = eye_cascade.detectMultiScale(roi_gray)
            for (ex, ey, ew, eh) in eyes:
                cv2.rectangle(roi_color, (ex, ey), (ex+ew, ey+eh), (0, 255, 0), 2)

            fgmask = bg_sub.apply(frame)

        combined_frame = cv2.hconcat([frame, fgmask, sketch])

        _, buffer = cv2.imencode('.jpg', combined_frame)
        frame = buffer.tobytes()

        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')

@app.route('/')
def index():
    """Renders the home page."""
    return render_template('index.html')

@app.route('/video_feed')
def video_feed():
    """Video streaming route. Serves the video feed."""
    return Response(generate_frames(),
                    mimetype='multipart/x-mixed-replace; boundary=frame')

if __name__ == '__main__':
    app.run(debug=True)
