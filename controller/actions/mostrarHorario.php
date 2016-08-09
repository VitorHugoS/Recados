<?php
session_start();
require ("../db/db.php");
require ("../calendario/calendario.php");
$id = $_POST["id"];
$calendario = new Calendario();
$result = $calendario->buscarEventos($PDO, $id);
$result = json_encode($result);
?>
		<script>
            //var clndrEvents = JSON.parse();
            var teste = <?=$result?>;
            var clndrEvents = JSON.parse(teste);
        </script>
        {% verbatim %}
         <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-1-2">
                    <h2 class="uk-text-center">Agendamentos</h2>
                    <div class="md-card">
                        <div id="clndr_events" class="clndr-wrapper">
                            <script id="clndr_events_template" type="text/x-handlebars-template">
                                <div class="md-card-toolbar">
                                    <div class="md-card-toolbar-actions">
                                        <i class="md-icon clndr_add_event material-icons">&#xE145;</i>
                                        <i class="md-icon clndr_today material-icons">&#xE8DF;</i>
                                        <i class="md-icon clndr_previous material-icons">&#xE408;</i>
                                        <i class="md-icon clndr_next material-icons uk-margin-remove">&#xE409;</i>
                                    </div>
                                    <h3 class="md-card-toolbar-heading-text">
                                        {{ month }} {{ year }}
                                    </h3>
                                </div>
                                <div class="clndr_days">
                                    <div class="clndr_days_names">
                                        {{#each daysOfTheWeek}}
                                        <div class="day-header">{{ this }}</div>
                                        {{/each}}
                                    </div>
                                    <div class="clndr_days_grid">
                                        {{#each days}}
                                        <div class="{{ this.classes }}" {{#if this.id }} id="{{ this.id }}" {{/if}}>
                                            <span>{{ this.day }}</span>
                                        </div>
                                        {{/each}}
                                    </div>
                                </div>
                                <div class="clndr_events">
                                    <i class="material-icons clndr_events_close_button">&#xE5CD;</i>
                                    {{#each eventsThisMonth}}
                                    <div class="clndr_event" data-clndr-event="{{ dateFormat this.date format='YYYY-MM-DD' }}">
                                        <a href="{{ this.url }}">
                                            <span class="clndr_event_title">{{ this.title }}</span>
                                            <span class="clndr_event_more_info">
                                                {{~dateFormat this.date format='MMM Do'}}
                                                {{~#ifCond this.timeStart '||' this.timeEnd}} ({{/ifCond}}
                                                {{~#if this.timeStart }} {{~this.timeStart~}} {{/if}}
                                                {{~#ifCond this.timeStart '&&' this.timeEnd}} - {{/ifCond}}
                                                {{~#if this.timeEnd }} {{~this.timeEnd~}} {{/if}}
                                                {{~#ifCond this.timeStart '||' this.timeEnd}}){{/ifCond~}}
                                            </span>
                                        </a>
                                    </div>
                                    {{/each}}
                                </div>
                            </script>
                        </div>
                        {% endverbatim %}

                        <div class="uk-modal" id="modal_clndr_new_event">
                            <div class="uk-modal-dialog">
                                <div class="uk-modal-header">
                                    <h3 class="uk-modal-title">Novo</h3>
                                </div>
                                <div class="uk-margin-bottom">
                                    <label for="clndr_event_title_control">Lugar</label>
                                    <input type="text" name="lugar" class="md-input" id="clndr_event_title_control" />
                                </div>
                                <div class="uk-margin-medium-bottom">
                                    <input type="hidden" class="md-input" id="clndr_event_link_control" />
                                </div>
                                <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-large-bottom" data-uk-grid-margin>
                                    <div>
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                            <label for="clndr_event_date_control">Dia</label>
                                            <input class="md-input" name="dia" type="text" id="clndr_event_date_control" data-uk-datepicker="{format:'YYYY-MM-DD', addClass: 'dropdown-modal', i18n: { months:['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'], weekdays:['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'] }    }">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                            <label for="clndr_event_start_control">Saída</label>
                                            <input class="md-input" type="text" name="saida" id="clndr_event_start_control" data-uk-timepicker="{format: '24h', start: 8, end: 18}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                            <label for="clndr_event_end_control">Chegada</label>
                                            <input class="md-input" type="text" name="chegada" id="clndr_event_end_control" data-uk-timepicker="{format: '24h', start: 8, end: 19}">
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-modal-footer uk-text-right">
                                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Fechar</button><button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="enviar({{usuario[0].id}})" id="clndr_new_event_submit">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>