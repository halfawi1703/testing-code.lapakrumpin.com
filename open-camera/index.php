<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Kamera</title>
</head>
<body>
    <button id="startCameraButton">Buka Kamera</button>
    <video id="videoElement" autoplay></video>

    <script>
        const startCameraButton = document.getElementById('startCameraButton');
        const videoElement = document.getElementById('videoElement');

        startCameraButton.addEventListener('click', () => {
            // Meminta izin akses kamera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    // Menggunakan stream (menampilkan video di elemen HTML)
                    videoElement.srcObject = stream;
                })
                .catch(function(err) {
                    console.error('Gagal mengakses kamera:', err);
                });
        });
    </script>
</body>
</html>
