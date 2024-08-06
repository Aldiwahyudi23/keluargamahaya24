<!-- resources/views/inspection-form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspeksi Mobil Bekas</title>
    <link href="{{ asset('layouts/dist/css/app.css') }}" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
        .img-preview {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            position: relative;
        }
        .img-preview img {
            width: 100%;
        }
        .img-preview .delete-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Inspeksi Mobil Bekas</h3>
            </div>
            <div class="card-body">
                <form id="inspectionForm" action="/inspections" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $parts = ['Bulkhead Kiri', 'Bulkhead Kanan', 'Bagian 3', 'Bagian 4', 'Bagian 5', 'Bagian 6', 'Bagian 7', 'Bagian 8', 'Bagian 9', 'Bagian 10'];
                    @endphp

                    @foreach($parts as $part)
                        <div class="mb-4">
                            <h5>{{ $part }}</h5>
                            <input type="hidden" name="parts[{{ $loop->index }}][name]" value="{{ $part }}">
                            <div class="mb-3">
                                <label for="image{{ $loop->index }}" class="form-label">Upload Gambar:</label>
                                <input type="file" id="image{{ $loop->index }}" accept="image/*" capture="camera" class="form-control hidden">
                                <button type="button" id="cameraButton{{ $loop->index }}" class="btn btn-primary">Ambil Foto</button>
                                <div id="imagePreviewContainer{{ $loop->index }}" class="img-preview hidden">
                                    <img id="imagePreview{{ $loop->index }}" src="#" alt="Image preview">
                                    <span class="delete-icon" id="deleteIcon{{ $loop->index }}">X</span>
                                </div>
                                <input type="hidden" id="imagePath{{ $loop->index }}" name="parts[{{ $loop->index }}][image_path]">
                            </div>

                            <div class="mb-3">
                                <label>Status:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="oke{{ $loop->index }}" name="parts[{{ $loop->index }}][status]" value="1" checked>
                                    <label class="form-check-label" for="oke{{ $loop->index }}">Oke</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="tidakOke{{ $loop->index }}" name="parts[{{ $loop->index }}][status]" value="0">
                                    <label class="form-check-label" for="tidakOke{{ $loop->index }}">Tidak Oke</label>
                                </div>
                            </div>

                            <div id="descriptionField{{ $loop->index }}" class="mb-3 hidden">
                                <label for="description{{ $loop->index }}" class="form-label">Deskripsi:</label>
                                <textarea id="description{{ $loop->index }}" name="parts[{{ $loop->index }}][description]" class="form-control"></textarea>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('layouts/dist/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parts = @json($parts);

            function loadFormData() {
                parts.forEach((part, index) => {
                    const imagePath = localStorage.getItem(`imagePath${index}`);
                    if (imagePath) {
                        document.getElementById(`imagePath${index}`).value = imagePath;
                        document.getElementById(`imagePreview${index}`).src = imagePath;
                        document.getElementById(`imagePreviewContainer${index}`).classList.remove('hidden');
                        document.getElementById(`cameraButton${index}`).classList.add('hidden');
                    }

                    const status = localStorage.getItem(`status${index}`);
                    if (status) {
                        document.querySelector(`input[name="parts[${index}][status]"][value="${status}"]`).checked = true;
                        if (status == '0') {
                            document.getElementById(`descriptionField${index}`).classList.remove('hidden');
                        }
                    }

                    const description = localStorage.getItem(`description${index}`);
                    if (description) {
                        document.getElementById(`description${index}`).value = description;
                    }
                });
            }

            function saveFormData() {
                parts.forEach((part, index) => {
                    const imagePath = document.getElementById(`imagePath${index}`).value;
                    localStorage.setItem(`imagePath${index}`, imagePath);

                    const status = document.querySelector(`input[name="parts[${index}][status]"]:checked`).value;
                    localStorage.setItem(`status${index}`, status);

                    const description = document.getElementById(`description${index}`).value;
                    localStorage.setItem(`description${index}`, description);
                });
            }

            parts.forEach((part, index) => {
                document.getElementById(`cameraButton${index}`).addEventListener('click', function() {
                    document.getElementById(`image${index}`).click();
                });

                document.getElementById(`image${index}`).addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(`imagePreview${index}`).src = e.target.result;
                            document.getElementById(`imagePreviewContainer${index}`).classList.remove('hidden');
                            document.getElementById(`cameraButton${index}`).classList.add('hidden');
                            localStorage.setItem(`imagePath${index}`, e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                document.getElementById(`deleteIcon${index}`).addEventListener('click', function() {
                    document.getElementById(`imagePreviewContainer${index}`).classList.add('hidden');
                    document.getElementById(`cameraButton${index}`).classList.remove('hidden');
                    document.getElementById(`image${index}`).value = '';
                    localStorage.removeItem(`imagePath${index}`);
                });

                document.querySelectorAll(`input[name="parts[${index}][status]"]`).forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value == '0') {
                            document.getElementById(`descriptionField${index}`).classList.remove('hidden');
                        } else {
                            document.getElementById(`descriptionField${index}`).classList.add('hidden');
                        }
                        localStorage.setItem(`status${index}`, this.value);
                    });
                });

                document.getElementById(`description${index}`).addEventListener('input', function() {
                    localStorage.setItem(`description${index}`, this.value);
                });
            });

            document.getElementById('inspectionForm').addEventListener('submit', function() {
                localStorage.clear();
            });

            loadFormData();
        });
    </script>
</body>
</html>
