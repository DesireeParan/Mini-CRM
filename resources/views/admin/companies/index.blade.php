@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
    <div class="container mt-3">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Add new</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        Show
                        <select id="entries-count" class="custom-select custom-select-sm form-control form-control-sm" style="width: auto;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </div>
                </div>

                <table id="companies-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td><input type="checkbox" class="select-item" value="{{ $company->id }}"></td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="50" height="50">
                                    @else
                                        No Logo
                                    @endif
                                </td>
                                <td>
                                    @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                    @else
                                        No Website
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-icon btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-icon btn-sm" onclick="confirmDelete({{ $company->id }}, '{{ $company->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteModalBody">
                    Are you sure you want to delete this company?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .table thead th {
            border-bottom: 1px solid #dee2e6;
        }
        .table tbody td {
            border: none;
        }
        .btn-icon {
            background-color: transparent;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .btn-icon i {
            color: #333;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#companies-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)',
                            customize: function (doc) {
                                doc.content[1].table.body.forEach(function (row) {
                                    if (row[3].text) {
                                        var img = row[3].text;
                                        row[3] = {
                                            image: img,
                                            width: 50,
                                            height: 50
                                        };
                                    }
                                });
                            }
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],
                lengthMenu: [10, 25, 50, 100]
            });

            $('#select-all').click(function() {
                $('.select-item').prop('checked', this.checked);
            });

            $('#entries-count').change(function() {
                var value = $(this).val();
                table.page.len(value).draw();
            });
        });

        function confirmDelete(companyId, companyName) {
            $('#deleteModalBody').text(`Are you sure you want to delete the company "${companyName}"?`);
            $('#deleteModal').modal('show');
            $('#confirmDeleteButton').attr('onclick', `deleteCompany(${companyId})`);
        }

        function deleteCompany(companyId) {
            document.getElementById(`delete-form-${companyId}`).submit();
        }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("#companies-table tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");

                for (var j = 0; j < cols.length - 1; j++) {
                    if (j === 3) {
                        var img = cols[j].querySelector('img');
                        row.push(img ? img.src : 'No Logo');
                    } else {
                        row.push(cols[j].innerText);
                    }
                }

                csv.push(row.join(","));
            }

            // CSV
            var csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
            var downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }

        function exportTableToPDF() {
            var doc = new jsPDF();
            doc.autoTable({
                html: '#companies-table',
                columnStyles: {
                    3: { cellWidth: 50 }
                },
                didDrawCell: function (data) {
                    if (data.column.index === 3 && data.cell.section === 'body') {
                        var img = data.cell.raw.querySelector('img');
                        if (img) {
                            var dim = data.cell.height - data.cell.padding('vertical');
                            var textPos = data.cell.textPos;
                            doc.addImage(img.src, textPos.x, textPos.y, dim, dim);
                        }
                    }
                }
            });
            doc.save('companies.pdf');
        }

        function exportTableToDOCX() {
            var content = document.getElementById('companies-table').outerHTML;
            var blob = new Blob(['\ufeff', content], {
                type: 'application/msword'
            });
            var url = URL.createObjectURL(blob);
            var link = document.createElement('a');
            link.href = url;
            link.download = 'companies.doc';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function copyTable() {
            var range = document.createRange();
            range.selectNode(document.getElementById('companies-table'));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            alert('Table copied to clipboard');
        }
    </script>
@stop
