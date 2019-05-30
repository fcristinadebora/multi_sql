<html lang="pt-bt">
    <head>
        <title>Multi SQL</title>

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <style>
            body{
                padding-top: 50px;
                padding-bottom: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div id="header" class="text-center">
                <h1>Multi SQL</h1>
                <p>Executa um script SQL em todas as bases selecionadas</p>
            </div>
            <div class="container">
                <form onsubmit="handleFormSubmit(event)">
                    <div class="form-group">
                        <label for="sql-script"><strong>Script SQL</strong></label>
                        <textarea name="sql_script" class="form-control" id="sql-script" rows="5" placeholder="Digite aqui o script SQL a ser executado"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <strong>Bases de dados</strong>
                            <br>Selecione abaixo as bases de dados em que deseja executar o script
                        </label>
                        <table class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>Sel.</th>
                                <th>Alias</th>
                                <th>Host</th>
                                <th>Base de dados</th>
                                <th>Usuário</th>
                            </thead>
                            <tbody id="databases-list">
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group">
                        <strong>RETORNO</strong>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right">Executar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="execution-result" class="col-md-12"></div>
            </div>
        </div>

        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <script>
            $(window).ready(function () {
                $.get('src/databases-loader.php')
                    .then(response => {
                        $("#databases-list").html(response)
                    })
            })

            function handleFormSubmit(event){
                event.preventDefault();
                
                $checked = $('.chk_db:checked');
                $script = $('#sql-script').val();

                if($script.length == 0){
                    alert('Forneça um script!');
                    return false;
                }

                for($i = 0; $i < $checked.length; $i++){
                    $index = $($checked[$i]).val();

                    var postData = {
                        'script' : $script,
                        'name' : $('#name_'+$index).val(),
                        'driver' : $('#driver_'+$index).val(),
                        'host' : $('#host_'+$index).val(),
                        'user' : $('#user_'+$index).val(),
                        'password' : $('#password_'+$index).val(),
                        'database' : $('#database_'+$index).val()
                    }

                    $url = 'src/execute-script.php';
                    $.post($url, postData)
                        .then(res => {
                            var current_html = $('#execution-result').html();

                            current_html += `<pre>${res}</pre><hr>`;

                            $('#execution-result').html(current_html);
                        })
                }
            }
        </script>
    </body>
</html>


