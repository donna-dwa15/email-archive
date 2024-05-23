# The Email Archive

## Description

The Email Archive is a Laravel web application that allows the uploading, saving and viewing of email .eml file data.  Users can provide optional Tags to provide additional data to include with their uploaded data.

Users also have the option of uploading via an API POST request to the api/upload endpoint.

## Local Setup

Please note:  Herd was used for local development of this project.

Run the following commands to get this project up and running locally:
```
git clone https://github.com/donna-dwa15/email-archive.git email-archive
cd email-archive
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

Now you should be able to access the app through your browser by going to:
http://email-archive.test


## POST API Instructions

With the email-archive project running, you can POST an upload request to the following endpoint:<br/>
http://email-archive.test/api/upload

POST data:
<table>
    <tr><th>Field</th><th>Description</th><th>Required?</th></tr>
    <tr><td>file</td><td>The file to be uploaded</td><td>Yes</td></tr>
    <tr><td>tags</td><td>A comma delimited string of descriptive tags to associate with the file.</td><td>No</td></tr>
</table>

Be sure to post using a header "content-type" of "multipart/form-data".
If using Postman, this can be done under the "Body" tab:  
1.  Select "form-data" 
2.  When entering the "Key" for "file", make sure to also select "File" from the dropdown.

## Additional Information

Various TailwindUI templates were used and modified for this project.

Header Icon used provided by:<br/>
<a href="https://www.flaticon.com/free-icons/magnifier" title="magnifier icons">Magnifier icons created by graphicmall - Flaticon</a>

3rd Party Packages used:
- vite.js
- blade-ui-kit/blade-zondicons
- zbateson/mail-mime-parser
