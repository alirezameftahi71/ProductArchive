<?php include "../include/_layout/header.html";?>
<script src="../include/_js/queries.js"></script>
<div class="row text-center full-height">
    <div class="col-sm-12 h-100 d-table">
        <div class="d-table-cell align-middle">
            <table id="query-builder" class="table table-bordered table-striped mt-5">
                <thead>
                    <tr>
                        <th><input class="form-control btn btn-outline-dark" id="add-row-btn" type="button" value="Add"></th>
                        <th>Field</th>
                        <th>Value</th>
                        <th>Operator</th>
                        <th>AND/OR</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../include/_layout/footer.html";?>