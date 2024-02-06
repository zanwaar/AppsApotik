<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <div class="form-group">
        <label>Select2</label>
        <select id="mySelect2" class="form-control mySelect2">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.mySelect2').select2({
                ajax: {
                    url: '{{ route("fetch") }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        console.log('Data from server:', data);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.nama_obat
                                };
                            })
                        };
                    },
                    cache: true
                }
            }).on('change', function(e) {});
        });
    </script>
</body>

</html>