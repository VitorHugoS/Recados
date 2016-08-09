<?php
require ("../db/db.php");
$id = $_POST["id"];
$atualizar=$PDO->query("UPDATE recados SET visto=now() where hash= '$id'");
$atualizar->execute();

$buscar=$PDO->prepare("SELECT * FROM recados r INNER JOIN empresa e on r.empresa = e.id where r.hash=:user");
$buscar->bindValue(":user", $id, PDO::PARAM_INT);
$buscar->execute();
$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
$idU=$lista[0]["create_user"];
$buscarNome=$PDO->query("SELECT usuario from login where id = '$idU'");
$buscarNome->execute();
$resultado = $buscarNome->fetchAll(PDO::FETCH_ASSOC);

$status = ($lista[0]["concluido"]==1)?"Concluído":"Em espera";
$prioridade = ($lista[0]["tipo"]==1)?"Normal":"Urgente";
echo '
<div id="mensagem" class="'.$id.' uk-grid uk-grid-divider" data-uk-grid-margin>
                    <div class="uk-width-medium-3-4">
                        <div class="uk-margin-large-bottom">
                            <h2 class="heading_c uk-margin-small-bottom">'.$lista[0]["titulo"].'</h2>
                           '.$lista[0]["texto"].'
                        </div>
                        
                        
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-margin-medium-bottom">
                            <p>
                                Prioridade:
                                <span class="uk-badge uk-badge-success uk-text-upper uk-margin-small-left">'.$prioridade.'</span>
                            </p>
                            <p>
                                Status:
                                <span class="uk-badge uk-badge-outline uk-text-upper uk-margin-small-left">'.$status.'</span>
                            </p>
                        </div>
                        <h2 class="heading_c uk-margin-small-bottom">Detalhes</h2>
                        <ul class="md-list md-list-addon">
                            <li>
                           		 <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">person</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">'.$resultado[0]["usuario"].'</span>
                                    <span class="uk-text-small uk-text-muted">Criado por</span>
                                </div>
                            </li>
                            <li>
                           		 <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">domain</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">'.$lista[0]["empresa"].'</span>
                                    <span class="uk-text-small uk-text-muted">Empresa</span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">&#xE8DF;</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">'.$lista[0]["hora"].'</span>
                                    <span class="uk-text-small uk-text-muted">Criado</span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">&#xE8B5;</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">'.$lista[0]["visto"].'</span>
                                    <span class="uk-text-small uk-text-muted">Última vez visto</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>';
     ?><div class="md-fab-wrapper" style="right: 0px; left: 10px;">
        <a class="md-fab md-fab-accent" href="#" onclick="concluir('<?=$id?>')">
            <i class="material-icons">done_all</i>	
        </a>
        </div>
