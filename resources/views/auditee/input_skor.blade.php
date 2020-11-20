@extends('layouts.app')

@section('content')

<div>
    <div class="container">
        <div class="fade-in">
            <div class="row">
                <!-- /.col-->
                <div class="col-lg-12">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('message')}}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i>Instrumen AMI</div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Indikator Penilaian</th>
                                            <th>Skor Taksiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach ($audits as $audit)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$audit->desc}}</td>
                                        <td>{{$audit->score_auditee}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#viewDetail" id='detailSkor'
                                                data-id="{{$audit->id_audit}}"
                                                onClick="setIdQuestion('{{$audit->id_question}}')">
                                                <i class="cil-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $audits->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
        <!-- /.row-->
    </div>
</div>
@endsection
</div>

<!-- view add score -->
<div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detial Pengisian Skor Audit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>Skor</th>
                            <th>Desc</th>
                        </tr>
                    </thead>
                    <tbody id="body_table">
                    </tbody>
                </table>
                <form action="#" id="auditeeScore" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Tambah Skor</label>
                        <input type="int" name="score_auditee" class="form-control" id="score_auditee" placeholder="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" onClick="addScore()" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('javascript')
<script>
      function setIdQuestion(id_question) {
        baseUrl = "{{url('/')}}" + "/skor_taksiran" + "/{{$id_audit}}" + "/" + id_question;
    }

    function addScore() {
        $('#addScore').modal('show');
        $('#auditeeScore').attr('action', baseUrl);
    }

    $(document).on("click", "#detailSkor", function () {
        var id = $(this).data("id");
        var base_url = "{{ url('/') }}";
        var rows = '';

        $.ajax({
            method: "GET",
            dataType: 'json',
            url: base_url + "/skor_taksiran/get_data/" + id,
            success: function (data) {
                var detail = data.data_score;
                $.each(detail, function (key, value) {
                    rows = rows + "<tr>";
                    rows = rows + "<td>" + value.score + "</td>";
                    rows = rows + "<td>" + value.desc + "</td>";
                    rows = rows + "</tr>";
                })
                $("#body_table").html(rows);
            }
        });
    });

</script>

@endsection
