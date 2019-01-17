<?php include "../include/_layout/header.html";?>
<script src="../include/_js/queries.js"></script>
<form>
    <div class="row text-center full-height">
        <div class="col-sm-12 h-100 d-table">
            <div class="d-table-cell align-middle">
                <table id="query-builder" class="table table-bordered table-striped mt-5">
                    <thead>
                        <tr>
                            <th><input class="form-control btn btn-outline-dark" id="add-row-btn" type="button" value="Add"></th>
                            <th>Field</th>
                            <th>Operator</th>
                            <th>Value</th>
                            <th>AND/OR</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="fixed-width-table table table-bordered table-striped mt-5">
                    <tr>
                        <td>
                            <input id="btn-submit" type="button" class="btn btn-primary" value="Submit">
                        </td>
                    </tr>
                </table>
                <table id="result-table" style="display:none;">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="title">Title</th>
                            <th data-field="released_date">Released Date</th>
                            <th data-field="genre">Genre(s)</th>
                            <th data-field="platform">Platform(s)</th>
                            <th data-field="publishers">Publishers(s)</th>
                            <th data-field="rate">Rate/5</th>
                            <th data-field="description">Description</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</form>
<?php include "../include/_layout/footer.html";?>