<template>
    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sortable table</h4>
            <h6 class="card-subtitle">Basic sortable table</h6>
            <table
                data-toggle="table"
                data-mobile-responsive="true"
                class="table table-bordered"
                data-sort-order="default"
            >
                <!-- -->
                <thead>
                    <tr>
                        <th class="detail"></th>
                        <th data-sortable="" data-width="auto">
                            Actual situation
                        </th>
                        <th
                            data-field="forks_count"
                            data-sortable=""
                            data-width="auto"
                        >
                            Scenario 2
                        </th>
                        <th
                            data-field="description"
                            data-sortable=""
                            data-width="auto"
                        >
                            Scenario n
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total de puntos</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>Factor 1: Factores centrales de capital humano</td>
                        <td>1</td>
                        <td>4</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Factor 2: Transferibilidad de actividades</td>
                        <td>2</td>
                        <td>3</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Factor 3: Puntos adicionales</td>
                        <td>2</td>
                        <td>3</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>
                            Factor 4: Atributos de pareja (En caso de que
                            aplique)
                        </td>
                        <td>2</td>
                        <td>3</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
table {
    height: auto;
    overflow: auto;
    position: relative;
}
.card {
    height: 100%;
}
</style>
