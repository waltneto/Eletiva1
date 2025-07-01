<?php
    require_once('cabecalho.php');

    function retornarCursosDashboard(){
        require("conexao.php");
        try{
            $sql = "SELECT nome, preco FROM cursos";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e){
            die("Erro ao consultar cursos para dashboard: " . $e->getMessage());
        }
    }

    $cursos_dashboard = retornarCursosDashboard();
?>

<h1> Dashboard da Plataforma de Cursos </h1>

<p>
    <a href="relatorio_cursos.php" target="_blank" class="btn btn-info">Relatório de Cursos</a>
    <a href="relatorio_alunos.php" target="_blank" class="btn btn-info">Relatório de Alunos</a>
    <a href="relatorio_professores.php" target="_blank" class="btn btn-info">Relatório de Professores</a>
    <a href="relatorio_matriculas.php" target="_blank" class="btn btn-info">Relatório de Matrículas</a>
</p>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {
        var data = google.visualization.arrayToDataTable([
            ['Curso', 'Preço'],
            <?php
                foreach($cursos_dashboard as $c){
                    $nome = $c['nome'];
                    $preco = $c['preco'];
                    echo "['$nome', $preco],";
                }
            ?>
        ]);

        var options = {
                title: 'Preço dos Cursos',
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'Preço',
                    minValue: 0
                },
                vAxis: {
                    title: 'Nome do Curso'
                }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<?php
    require_once('rodape.php');
?>