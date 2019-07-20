//$(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('note.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'note', name: 'note'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable:false, searchable:false},
            ]
        });

        $('#createNewNotes').click(function(){
            $('#notes_id').val('');
            $('#notesForm').trigger('reset');
            $('#modalHeading').html('Create New Note');
            $('#modalNotes').modal('show');
        });

        $('#saveBtn').click(function(e){
            e.preventDefault();
            $(this).html('Sending...');

            $.ajax({
                data: $('#notesForm').serialize(),
                url: "{{ route('note.store') }}",
                type: "POST",
                dataType: "json",
                success: function(data){
                    $('#notesForm').trigger('reset');
                    $('#modalNotes').modal('hide');
                    toastr.success(data.success, 'Success');
                    table.draw();
                },error: function(data){
                    console.log(data);
                }
            })
        });

        $('body').on('click', '.editNote', function(){
            var note_id = $(this).data('id');

            $.get("{{ route('note.index') }}" + '/' + note_id + '/edit', function(data) {
                $('#modalHeadingEdit').html('Edit Note');
                $('#modalNotesEdit').modal('show');
                $('#notes_idEdit').val(data.id);
                $('#nameEdit').val(data.name);
                $('#usernameEdit').val(data.username);
                $('#passwordEdit').val(data.password);
                $('#linkEdit').val(data.link);
                $('#noteEdit').val(data.note);
            });
        });

        $('#saveBtnEdit').click(function(e){
            e.preventDefault();
            $(this).html('Sending...');
            var id = $('#notes_idEdit').val();

            $.ajax({
                data: $('#notesFormEdit').serialize(),
                url: "{{ route('note.store') }}" + '/' + id,
                type: "PUT",
                dataType: "json",
                success: function(data){
                    $('#notesFormEdit').trigger('reset');
                    $('#modalNotesEdit').modal('hide');
                    // $('#alert_success').show();
                    // $('#alert_success').html(data.success + $('#btnClose').html());
                    toastr.success(data.success, 'Success');
                    table.draw();
                }, error: function(data){
                    console.log(data);
                } 
            })
        });

        $('body').on('click', '.detailNote', function(){
            var note_id = $(this).data('id');
            $.get(
                "{{ route('note.index') }}" + '/' + note_id + '/edit',
                function(data){
                    $('#modalDetail').modal('show');
                    $('#nameDetail').html(data.name);
                    $('#usernameDetail').html(data.username);
                    $('#passwordDetail').html(data.password);
                    $('#linkDetail').html(data.link);
                    $('#linkDetail').attr("href", data.link);
                    $('#noteDetail').html(data.note);
                });
        });
        
        $('body').on('click', '.deleteNote', function(){
            var note_id = $(this).data('id');

            // Delete Confirm
            swalWithBootstrapButtons.fire({
                title: 'Are You sure want to delete?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                 if (result.value){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('note.store') }}" + '/' + note_id,
                        success: function(data){
                        toastr.error(data.success, "Success");
                        
                        table.draw()
                        // console.log(swalDelete(data.success, "Success"));
                        // table.draw();    
                        }, error: function(data){
                        console.log('Error:', data);
                        }
                    })
                    //  toastr.error(msg, title);
                 }
            }) -->

            
            
                <!-- // $.ajax({
                // type: "DELETE",
                // url: "{{ route('note.store') }}" + '/' + note_id,
                // success: function(data){
                //     toastr.error(data.success, "Success");
                    
                //     table.draw()
                //     // console.log(swalDelete(data.success, "Success"));
                //     // table.draw();    
                // }, error: function(data){
                //     console.log('Error:', data);
                // }
                // }) -->
            
            
        })

