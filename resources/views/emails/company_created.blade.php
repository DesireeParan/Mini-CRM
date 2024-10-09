<!-- resources/views/emails/company_created.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>New Company Created</title>
</head>
<body>
    <h1>New Company Created</h1>
    <p>A new company has been created:</p>
    <ul>
        <li>Name: {{ $company->name }}</li>
        <li>Email: {{ $company->email }}</li>
        <li>Website: {{ $company->website }}</li>
    </ul>
</body>
</html>
