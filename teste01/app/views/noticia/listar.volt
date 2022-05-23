{% extends 'layouts/index.volt' %}

    {%  block extrafooter %}
        <link href="{{ static_url("css/datatables.min.css") }}" rel="stylesheet">
    {% endblock %}

    {% block content %}
            <div class="row">
                <div class="col-md-12" id="conteudo">
                    <!-- <div class="col-md-6 col-sm-6"> -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <!-- <a href="#" class="pull-right">View all</a> -->
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                &nbsp;Notícias
                                <form class="navbar-form navbar-right" id="search_ticket" role="search">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                            <input id="dataTableSearch" type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <a id="button-abrir-ticket" href="{{ url(['for':'noticia.cadastrar']) }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Nova Noticia</a>
                                    
                                </div>
                
								<table id="lista-noticia" class="table dataTable table-hover">
									<thead>
										<tr>
											<td>Cod</td>
											<td>Titulo</td>
											<td>Texto</td>
											<td>Ações</td>
										</tr>
									</thead>
									<tbody>
                                        <?php foreach ($noticias as $noticia) { ?>
                                            <tr>
                                                <td><a href="#">#<?php echo $noticia->id; ?></a></td>
                                                <td class="titulo"><?php echo $noticia->titulo; ?></td>
                                                <td class="text-center"><?php echo $noticia->texto; ?></td>
                                                <td>
                                                    <a href="{{ url(['for':'noticia.editar',"id":noticia.id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a href="{{ url(['for':'noticia.excluir',"id":noticia.id]) }}"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
									
									</tbody>
								</table>
                            </div><!-- panel-body -->
                        </div>
                </div>
            </div><!-- row -->

    {% endblock %}

    {%  block extrafooter %}
        

        <script>

            $(document).ready(function(){

                
            });
        </script>


    {% endblock %}