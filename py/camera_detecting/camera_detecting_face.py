import cv2


############################################################################
# download the haarcascade_frontalface_default.xml and haarcascade_eye.xml #
# ########################################################################## 
cap = cv2.VideoCapture(0)

face_cascade = cv2.CascadeClassifier(
    # 'haarcascade_frontalface_default.xml'
)

eye_cascade = cv2.CascadeClassifier(
   # 'haarcascade_eye.xml'
)


bg_sub = cv2.createBackgroundSubtractorKNN()

while True:
    ret, frame = cap.read()

    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    invert_gray = cv2.bitwise_not(gray)
    
    blur = cv2.GaussianBlur(invert_gray, (21, 21), 0)
    invertblur = cv2.bitwise_not(blur)

    sketch = cv2.divide(gray, invertblur, scale=256.0)

    face = face_cascade.detectMultiScale(gray, 1.3, 5)

    for (x, y, w, h) in face:
        cv2.rectangle(frame, (x, y), (x+w, y+h), (255, 0, 0), 2)
        roi_gray = gray[y:y+h, x:x+w]
        roi_color = frame[y:y+h, x:x+w]
        eyes = eye_cascade.detectMultiScale(roi_gray)

        for (ex, ey, ew, eh) in eyes:
            cv2.rectangle(roi_color, (ex, ey), (ex+ew, ey+eh), (0, 255, 0), 0)

    if not ret:
        break

    fgmask = bg_sub.apply(frame)

    cv2.imshow('original', frame)
    cv2.imshow("foreground", fgmask)

    cv2.imshow("sketch", sketch)
    k = cv2.waitKey(30) & 0xff
    if k == 27:
        break

cap.release()
cv2.destroyAllWindows()


