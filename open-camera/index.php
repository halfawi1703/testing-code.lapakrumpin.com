<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Kamera</title>
</head>
<body>
    <button id="startCameraButton">Buka Kamera</button>
    <button id="stopCameraButton" disabled>Tutup Kamera</button>
    <video id="videoElement" autoplay></video>

    <script>
        const startCameraButton = document.getElementById('startCameraButton');
        const stopCameraButton = document.getElementById('stopCameraButton');
        const videoElement = document.getElementById('videoElement');
        let stream;

        startCameraButton.addEventListener('click', () => {
            // Meminta izin akses kamera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(mediaStream) {
                    stream = mediaStream;
                    // Menggunakan stream (menampilkan video di elemen HTML)
                    videoElement.srcObject = mediaStream;
                    startCameraButton.disabled = true;
                    stopCameraButton.disabled = false;

                    // Memunculkan notifikasi bahwa kamera diakses
                    if(Notification.permission === 'granted'){
                        new Notification('Kamera Diakses', {
                            body: 'Aplikasi sedang menggunakan kamera.'
                        });
                    }
                    else if (Notification.permission !== 'denied') {
                        Notification.requestPermission().then(function (permission) {
                            if (permission === 'granted') {
                                new Notification('Kamera Diakses', {
                                    body: 'Aplikasi sedang menggunakan kamera.'
                                });
                            }
                        });
                    }
                })
                .catch(function(err) {
                    console.error('Gagal mengakses kamera:', err);
                });
        });

        stopCameraButton.addEventListener('click', () => {
            // Menghentikan akses kamera dengan melepaskan stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                videoElement.srcObject = null;
                startCameraButton.disabled = false;
                stopCameraButton.disabled = true;
            }
        });
    </script>
</body>
</html>
