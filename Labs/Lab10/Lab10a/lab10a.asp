<%
    ' Read the color value from the query string
    Dim bgColor
    bgColor = Request.QueryString("color")

    ' Set default color if not provided
    If bgColor = "" Then
        bgColor = "white"
    End If

    ' Set a cookie to store the last visit time
    If Request.Cookies("LastVisit") = "" Then
        Response.Cookies("LastVisit") = Now()
        Response.Cookies("FirstVisit") = "Yes"
    Else
        Response.Cookies("LastVisit") = Now()
        Response.Cookies("FirstVisit") = "No"
    End If
%>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Color Page</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: <%= bgColor %>;
            transition: background-color 0.5s;
        }

        container {
            text-align: center;
        }

        card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            color: #555;
            margin: 10px 0;
        }

        small {
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Welcome to the Background Color Page</h1>
            <p>Last visit: <%= Request.Cookies("LastVisit") %></p>
            <p>First visit? <%= Request.Cookies("FirstVisit") %></p>
            <small>Experiment with different query strings to change the background color.</small>
        </div>
    </div>
</body>
</html>
