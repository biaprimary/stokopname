// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "aLengthMenu": [[5, 10, -1], [5, 10, "All"]],
    "ordering": false
  });
});
