<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edad</h4>
                <h6 class="card-subtitle">To use add <code>selected</code> to any particuler menu.</h6>
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                    <option>Select</option>
                    <option value="A17" data-select2-id="017"> 17 años o menos
                    </option>
                    <option value="A18" data-select2-id="018"> 18 años
                    </option>
                    <option value="A19" data-select2-id="019">19 años
                    </option>
                    <option value="A21" data-select2-id="021"> 21 a 29 años
                    </option>
                    @for ($i = 30; $i <= 44; $i++)
                        <option value="A{{ $i }}" data-select2-id="0{{ $i }}">
                            {{ $i }} años
                        </option>
                    @endfor
                    <option value="A45" data-select2-id="045"> 45 años o mas
                    </option>
                </select>

                <h4 class="card-title">Educación</h4>
                <h6 class="card-subtitle">To use add <code>selected</code> to any particuler menu.</h6>
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                    <option>Select</option>
                    <option value="ESM" data-select2-id="010">Secundaria o menos</option>
                    <option value="EPB" data-select2-id="011">Preparatoia o Bachiller
                    </option>
                    <optgroup label="Carrera profesional">
                        <option value="CPT1" data-select2-id="012">Carrera Profesional o técnica de 1 año de duración
                        </option>
                        <option value="CPT2" data-select2-id="013">Carrera Profesional o técnica de 2 años de duración
                        </option>
                        </option>
                        <option value="CPT3" data-select2-id="014">Carrera Profesional o técnica de 3 años de duración o
                            más
                        </option>
                        <option value="CTP" data-select2-id="015">2 o más carreras o titulos profesionales o técnicos
                            (uno tiene que
                            ser de al menos de 3 años)
                        </option>
                        <option value="EUM" data-select2-id="016">Maestría
                        </option>
                        <option value="EUD" data-select2-id="017">Doctoado
                        </option>
                    </optgroup>
                </select>

                {{-- ========================= --}}
                <h4 class="card-title">Idioma - Reading</h4>
                <h6 class="card-subtitle">To use add <code>selected</code> to any particuler menu.</h6>
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                    <option>Select</option>
                    <option value="CLB3" data-select2-id="201">Reading | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3
                        o menos
                    </option>
                    <option value="CLB4" data-select2-id="202">Reading | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 3.5
                    </option>
                    <option value="CLB5" data-select2-id="203">Reading | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 4
                    </option>
                    <option value="CLB6" data-select2-id="204">Reading | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.0
                    </option>
                    <option value="CLB7" data-select2-id="205">Reading | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6.0 | Mínimo
                        requerido
                        para FSW
                    </option>
                    <option value="CLB8" data-select2-id="206">Reading | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5
                    </option>
                    <option value="CLB9" data-select2-id="207">Reading | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 o 7.5
                    </option>
                    <option value="CLB10" data-select2-id="208">Reading | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8 o
                        más
                    </option>
                </select>
                {{-- ========================= --}}

                <h4 class="card-title">Idioma - Listening</h4>
                <h6 class="card-subtitle">To use add <code>selected</code> to any particuler menu.</h6>
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                    <option>Select</option>
                    <optgroup label="Sin Certificado de Calificacion">
                        <option value="CA" data-select2-id="790">Sin Certificado de Calificacion de
                            alguna provincia (CoQ)
                        </option>
                    </optgroup>
                    <optgroup label="Con Certificado de Calificación">
                        <option value="NV" data-select2-id="791">Con Certificado de Calificación de
                            alguna provincia (CoQ) y CLB Nivel 5 o más en inglés, y una al menos en CLB
                            Nivel 7
                        </option>
                        <option value="OR" data-select2-id="792">Con Certificado de Calificación de
                            alguna provincia (CoQ) y CLB Nivel 7 o más en todas las areas de ingles.
                        </option>
                    </optgroup>
                </select>

                {{-- ends tab --}}
            </div>
        </div>
    </div>
</div>
