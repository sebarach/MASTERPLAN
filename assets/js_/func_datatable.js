$(document).ready(function(){

	var t1= $('.tab').DataTable( {
	        scrollY: "150px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	$('.tab tbody').on('click','td',function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
		} else {
			tab.$('td.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('.tab1').DataTable( {
	        scrollY: "300px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    $('.tab2').DataTable( {
	        scrollY: "210px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );


	

	    
});