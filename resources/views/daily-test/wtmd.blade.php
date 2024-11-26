@if(!isset($isPdf))
    @extends('layouts.app')

    @section('content')
@endif


<div class="bg-gray-100 px-64">
    <div>
        <x-form-wtmd/>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date and time
        let now = new Date();

        // Format the date and time to match the input format (YYYY-MM-DDTHH:MM)
        let year = now.getFullYear();
        let month = (now.getMonth() + 1).toString().padStart(2, '0');
        let day = now.getDate().toString().padStart(2, '0');
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');

        let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the value of the input
        document.getElementById('testDateTime').value = formattedDateTime;
    });
    // Get the current date and time

    // Add this function to your form's onsubmit event
    function onFormSubmit(event) {
        event.preventDefault();
        document.getElementById('wtmdForm').submit();
    }

    function updateResult() {
        var test1 = document.getElementById('resultPassIntest1').checked;
        var test2 = document.getElementById('resultPassIntest2').checked;
        var test3 = document.getElementById('resultPassIntest3').checked;
        var test4 = document.getElementById('resultPassIntest4').checked;
        var test5 = document.getElementById('resultPassOuttest1').checked;
        var test6 = document.getElementById('resultPassOuttest2').checked;
        var test7 = document.getElementById('resultPassOuttest3').checked;
        var test8 = document.getElementById('resultPassOuttest4').checked;
        
        var resultPass = document.getElementById('resultPass');
        var resultFail = document.getElementById('resultFail');
        var resultHidden = document.getElementById('result');

        if (test1 && test2 && test3 && test4 && test5 && test6 && test7 && test8) {
            resultPass.checked = true;
            resultFail.checked = false;
            resultHidden.value = 'pass';
        } else {
            resultPass.checked = false;
            resultFail.checked = true;
            resultHidden.value = 'fail';
        }
    }

    // // Panggil updateResult saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateResult);

    // // Tambahkan event listener untuk setiap checkbox test
    document.getElementById('resultPassIntest1').addEventListener('change', updateResult);
    document.getElementById('resultPassIntest2').addEventListener('change', updateResult);
    document.getElementById('resultPassIntest3').addEventListener('change', updateResult);
    document.getElementById('resultPassIntest4').addEventListener('change', updateResult);
    document.getElementById('resultPassOuttest1').addEventListener('change', updateResult);
    document.getElementById('resultPassOuttest2').addEventListener('change', updateResult);
    document.getElementById('resultPassOuttest3').addEventListener('change', updateResult);
    document.getElementById('resultPassOuttest4').addEventListener('change', updateResult);

    // // Tambahkan event listener untuk form submission
    document.getElementById('wtmdForm').addEventListener('submit', function(event) {
        updateResult(); // Pastikan result diupdate sebelum form disubmit
    });

    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        function getCoordinates(e) {
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;
            
            const x = (e.clientX - rect.left) * scaleX;
            const y = (e.clientY - rect.top) * scaleY;
            return [x, y];
        }

        function startDrawing(e) {
            isDrawing = true;
            e.preventDefault(); // Prevent scrolling on touch devices
            const coords = e.type.includes('mouse') ? 
                [e.offsetX, e.offsetY] : 
                getCoordinates(e.touches[0]);
            
            [lastX, lastY] = coords;
            draw(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            e.preventDefault(); // Prevent scrolling on touch devices
            
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            const coords = e.type.includes('mouse') ? 
                [e.offsetX, e.offsetY] : 
                getCoordinates(e.touches[0]);

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(coords[0], coords[1]);
            ctx.stroke();
            [lastX, lastY] = coords;
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }

        // Mouse events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch events
        canvas.addEventListener('touchstart', startDrawing, { passive: false });
        canvas.addEventListener('touchmove', draw, { passive: false });
        canvas.addEventListener('touchend', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        document.getElementById('saveOfficerSignature').addEventListener('click', function() {
            const officerSignatureData = canvas.toDataURL('image/png');
            document.getElementById('officerSignatureData').value = officerSignatureData;
            alert('Tanda tangan Officer disimpan!');
        });
    });

</script>

@if(!isset($isPdf))
    @endsection
@endif
    