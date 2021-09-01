	                            <h3 onclick="cuenta.chgsec(this)">3. Formaci&oacute;n y trabajo</h3>
                                <fieldset style="display: none">
                                    <div class="alert-cuenta cuenta-4">
                                    </div>
                                    <div class="field">
                                        <label for="estudios">Estudios</label>
                                        <div class="input-fake">
                                            <select class="cuenta-save-4" name="estudios" id="estudios">
                                            	{foreach from=$tsPData.estudios key=val item=text}
                                                <option value="{$val}" {if $tsPerfil.p_estudios == $val}selected="selected"{/if}>{$text}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Idiomas</label>
                                        <div class="input-fake">
                                            <ul>
                                            	{foreach from=$tsPData.idiomas key=iid item=idioma}
                                                <li>
                                                    <span class="label-id">{$idioma}</span>
                                                    <select class="cuenta-save-4" name="idioma_{$iid}">
                                                        {foreach from=$tsPData.inivel key=val item=text}
                                                        <option value="{$val}" {if $tsPerfil.p_idiomas.$iid == $val}selected="selected"{/if}>{$text}</option>
                                                        {/foreach}
                                                    </select>
                                                </li>
                                                {/foreach}
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class="field">
                                        <label for="profesion">Profesi&oacute;n</label>
                                        <input class="text cuenta-save-4" maxlength="32" name="profesion" id="profesion" value="{$tsPerfil.p_profesion}"/>
                                    </div>
                                    <div class="field">
                                        <label for="empresa">Empresa</label>
                                        <input class="text cuenta-save-4" maxlength="32" name="empresa" id="empresa" value="{$tsPerfil.p_empresa}"/>
                                    </div>
                                    <div class="field">
                                        <label for="sector">Sector</label>
                                        <div class="input-fake">
                                            <select class="cuenta-save-4" name="sector" id="sector">
                                                {foreach from=$tsPData.sector key=val item=text}
                                                <option value="{$val}" {if $tsPerfil.p_sector == $val}selected="selected"{/if}>{$text}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="ingresos">Nivel de ingresos</label>
                                        <div class="input-fake">
                                            <select class="cuenta-save-4" name="ingresos" id="ingresos">
                                                {foreach from=$tsPData.ingresos key=val item=text}
                                                <option value="{$val}" {if $tsPerfil.p_ingresos == $val}selected="selected"{/if}>{$text}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="intereses_profesionales">Intereses Profesionales</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-4" name="intereses_profesionales" id="intereses_profesionales">{$tsPerfil.p_int_prof}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="habilidades_profesionales">Habilidades Profesionales</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-4" name="habilidades_profesionales" id="habilidades_profesionales">{$tsPerfil.p_hab_prof}</textarea>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <input type="button" value="Guardar y seguir" onclick="cuenta.save(4, true)" class="mBtn btnOk">
                                    </div>
                                </fieldset>