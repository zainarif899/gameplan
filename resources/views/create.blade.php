<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h2>Create User via API</h2>

    <form id="userForm">
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Upload File:</label>
            <input type="file" name="file">
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

    <script>
        document.getElementById('userForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('http://127.0.0.1:8000/api/users', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('User created successfully');
                    console.log(result);
                } else {
                    alert('Error: ' + result.message);
                    console.error(result);
                }

            } catch (error) {
                alert('Something went wrong');
                console.error(error);
            }
        });
    </script>
</body>
</html>
