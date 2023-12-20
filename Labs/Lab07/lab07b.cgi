#!/usr/bin/perl -wT 
use CGI':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser); 
use MIME::Base64;

# Create a new CGI object
my $cgi = CGI->new;

# Print the HTTP header
print $cgi->header;

# Process form data (handles both GET and POST requests)
my $firstName  = $cgi->param('firstName') || '';
my $lastName   = $cgi->param('lastName') || '';
my $street      = $cgi->param('street') || '';
my $city        = $cgi->param('city') || '';
my $postalCode = $cgi->param('postalCode') || '';
my $province    = $cgi->param('province') || '';
my $phone       = $cgi->param('phone') || '';
my $email       = $cgi->param('email') || '';

# Validate form inputs
my $error_message = '';
$error_message .= 'Invalid phone number. ' if ($phone !~ /^\d{10}$/);
$error_message .= 'Invalid postal code. ' if ($postalCode !~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/);
$error_message .= 'Invalid email address. ' if ($email !~ /^[^\s@]+@[^\s@]+\.[^\s@]+$/);

# Process uploaded file (photo)
my $photo_filename = $cgi->param('photo');
my $photo_content  = $cgi->upload('photo');
my $photo_path;

if ($photo_filename && $photo_content) {
    my $upload_dir = '/class-years/y2023/msaheb/public_html/cgi-bin/uploads/';  # Change this to your desired upload directory
    $photo_path = "$upload_dir/$photo_filename";
    
    open my $photo_fh, '>', $photo_path or die "Cannot open file: $!";
    binmode $photo_fh;
    while (read($photo_content, my $buffer, 1024)) {
        print $photo_fh $buffer;
    }
    close $photo_fh;
}


# Print HTML response
print <<END_HTML;
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 07b - Form Submission Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        #result-container {
            width: 50%;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }
        #error-message {
            color: red;
            font-weight: bold;
        }
        #photo {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            max-height: 200px; /* Set the maximum height as per your requirement */
        }
    </style>
</head>
<body>
    <div id="result-container">
        <h2>Form Submission Result</h2>
        $error_message
        <p><strong>First Name:</strong> $firstName</p>
        <p><strong>Last Name:</strong> $lastName</p>
        <p><strong>Street Name:</strong> $street</p>
        <p><strong>City:</strong> $city</p>
        <p><strong>Postal Code:</strong> $postalCode</p>
        <p><strong>Province:</strong> $province</p>
        <p><strong>Phone Number:</strong> $phone</p>
        <p><strong>Email Address:</strong> $email</p>
		<p><strong>Photograph:</strong> $photo_filename</p>
        <img id="photo" src="data:image/png;base64,@{[get_base64_encoded_photo($photo_path)]}" alt="Uploaded Photo">
    </div>
</body>
</html>
END_HTML

sub get_base64_encoded_photo {
    my ($photo_path) = @_;

    open my $photo_fh, '<', $photo_path or die "Cannot open file: $!";
    binmode $photo_fh;
    local $/;
    my $photo_data = <$photo_fh>;
    close $photo_fh;

    return encode_base64($photo_data);
}