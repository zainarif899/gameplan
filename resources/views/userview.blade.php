<!DOCTYPE html>
<html>
<head>
    <title>User Detail</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>User Info</h1>
    <div id="user"></div>

    <script>
        fetch('http://127.0.0.1:8000/api/users/5')
            .then(res => res.json())
            .then(data => {
                document.getElementById('user').innerHTML = `
                    <p><strong>ID:</strong> ${data.id}</p>
                    <p><strong>Name:</strong> ${data.name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>File:</strong> <a href="${data.file}">Download</a></p>
                    
                `;
            })
            .catch(err => {
                console.error("Error:", err);
            });
    </script>
</body>
</html>
