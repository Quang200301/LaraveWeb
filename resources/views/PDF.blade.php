<form action="/upload-pdf" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="pdf_file">
    <button type="submit">Upload PDF</button>
</form>