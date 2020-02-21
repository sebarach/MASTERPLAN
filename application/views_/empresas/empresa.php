<script src="<?php echo base_url("assets/js/libs/dropify/dist/js/dropify.min.js"); ?>"></script>
<main class="main" style="height: 100%;">
    <ol class="breadcrumb" id="breadcrumb">
	    <li class="breadcrumb-item active">
	        <a href="">Clientes</a>
	    </li>
	</ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-accent-theme">
                    	<?php
							$perm=$permisos["permisos"]-8;
							if($perm>=1){
								if($perm!=2 || $perm!=4){
									echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal1' onclick='limpiar(\"e_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
								}	
							}							
						?> 
                        <div class="card-body">
                            <section class="cd-horizontal-timeline">
                                <div class="timeline">
                                    <div class="events-wrapper">
                                        <div class="events">
                                            <ol>
                                                <li>
                                                    <a href="#0" data-date="01/01/2000" class="selected">#</a>
                                                </li>
                                                <?php 
                                                $x="A";
                                                for ($i=2; $i < 28; $i++) { ?>
                                                <li>
                                                    <a href="#0" data-date="0<?php echo $i; ?>/01/2000"><?php echo $x;?></a>
                                                </li>
                                                <?php 
                                                $x++;
                                            	} 
                                            	?>
                                            </ol>
                                            <span class="filling-line" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <ul class="cd-timeline-navigation">
                                        <li>
                                            <a href="#0" class="prev inactive">Prev</a>
                                        </li>
                                        <li>
                                            <a href="#0" class="next">Next</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="events-content">
                                    <ol>
                                        <li class="selected" data-date="01/01/2000">
                                        <?php foreach (range("A","Z") as $x) { ?>
                                       		<div class="row">
                                       			<div class="col-md-12">
                                       				<h4 class='text-theme'><?php echo $x; ?></h4>
                                       			</div>
                                       		</div>                                        	
                                        	<div class="row">
                                        		<?php foreach ($empresas as $e) {
                                        			if(strcasecmp(substr($e["empresa"], 0, 1),$x)==0){ ?>
                                        			<div class="col-md-4">
                                        				<div class="card">
                                        					<div class="card-body">
                                        					<?php  if(strlen($e["empresa"])>20){
																echo "<h6 class='text-theme'>".$e["empresa"]."</h6>";
															} else {
																echo "<h6 class='text-theme'>".$e["empresa"]."<br><br></h6>";
															} ?>
																<div class="row">
																<?php if($perm>=4){
																	if($perm!=2 || $perm!=1){			
																		echo "<div class='col-md-4'><span data-toggle='modal' data-target='#modal2' ><button type='button' data-toggle='tooltip' data-placement='bottom' title='Editar' class='btn btn-outline-theme btn-lg' onclick='empresa(\"".base64_encode($e["id_empresa"])."\")' style='margin-top:0;'><i class='fa  fa-pencil'></i></button></span></div>";					
																	}
																}
																for($j=0; $j<count($modulos); $j++) {
																	if($modulos[$j]=="Campanas"){
																		echo "<div class='col-md-4'><span><button type='button' class='btn btn-outline-theme btn-lg'  data-toggle='tooltip' data-placement='bottom' title='Campañas' onclick='campanas(\"".base64_encode($e["id_empresa"])."\")'><i class='mdi mdi mdi-google-circles-group'></i></button></span></div>";
																	}
																} ?>
																</div>
															</div>
														</div>
													</div>
												<?php 	}
													} ?>
                                        	</div>
                                        <?php } ?>
                                        </li>
                                        <?php 
                                        $x="A";
                                        for ($i=2; $i < 28; $i++) { ?>
                                        <li data-date="0<?php echo $i; ?>/01/2000">
                                        	<div class="row">
                                       			<div class="col-md-12">
                                       				<h4 class='text-theme'><?php echo $x; ?></h4>
                                       			</div>
                                       		</div> 
                                        	<div class="row">
                                            <?php foreach ($empresas as $e) {
											if(strcasecmp(substr($e["empresa"], 0, 1),$x)==0){ ?>
												<div class="col-md-4">
													<div class="card">
														<div class="card-body">
															<?php 
																if(strlen($e["empresa"])>20){
																echo "<h6 class='text-theme'>".$e["empresa"]."</h6>";
															} else {
																echo "<h6 class='text-theme'>".$e["empresa"]."<br><br></h6>";
															}
															?>
															<div class="row">
															<?php if($perm>=4){
																if($perm!=2 || $perm!=1){			
																	echo "<div class='col-md-4'><span data-toggle='modal' data-target='#modal2' ><button type='button' data-toggle='tooltip' data-placement='bottom' title='Editar' class='btn btn-outline-theme btn-lg' onclick='empresa(\"".base64_encode($e["id_empresa"])."\")' style='margin-top:0;'><i class='fa  fa-pencil'></i></button></span></div>";					
																}
															}
															for($j=0; $j<count($modulos); $j++) {
																if($modulos[$j]=="Campanas"){
																	echo "<div class='col-md-4'><span><button type='button' class='btn btn-outline-theme btn-lg'  data-toggle='tooltip' data-placement='bottom' title='Campañas' onclick='campanas(\"".base64_encode($e["id_empresa"])."\")'><i class='mdi mdi mdi-google-circles-group'></i></button></span></div>";
																}
															} 
															
															?>
															</div>
														</div>
													</div>
												</div>
											<?php }
											} 	
											?>
											</div>
                                        </li>	
                                        <?php 
                                        $x++; 
                                    	} ?>
                                    </ol>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("empresas/agregar"); ?>" onsubmit=" return valida_form('e_add');" enctype="multipart/form-data">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Cliente</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Cliente</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_empresaadd" name="txt_empresaadd">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Colores Entorno</label>
	            				<div class="row">
	            					<div class="col-md-4">
	            						<small>Principal&nbsp;</small>
	            						<input type="color"  id="txt_coloresadd1" name="txt_coloresadd1">
	            					</div>
	            					<div class="col-md-4">
	            						<small>Dashboard 1&nbsp;</small>
	            						<input type="color"  id="txt_coloresadd2" name="txt_coloresadd2">
	            					</div>
	            					<div class="col-md-4">
	            						<small>Dashboard 2&nbsp;</small>
	            						<input type="color"  id="txt_coloresadd3" name="txt_coloresadd3">
	            					</div>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Imagen Logo<br><small class="text-theme">Extensiones: .jpg, .png, .jpeg</small></label>
	            				<div class="input-group">
									<input type="file" class="dropify" data-default-file="" id="txt_logoadd" name="txt_logoadd">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Imagen Fondo<br><small class="text-theme">Extensiones: .jpg, .png, .jpeg</small></label>
	            				<div class="input-group">
									<input type="file" class="dropify" data-default-file="" id="txt_fondoadd" name="txt_fondoadd">
	            				</div>
	            			</div>
	            		</div>
	            		
	            	</div>
	            </div>
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("empresas/editar"); ?>" onsubmit=" return valida_form('e_edit');" enctype="multipart/form-data">
	            <div class="modal-header ">
	                <h6 class="modal-title">Editar Cliente</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Cliente</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_empresaedit" name="txt_empresaedit">
	            				</div>
	            				<input type='hidden' id="txt_empresaid" name="txt_empresaid">
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Colores Entorno</label>
	            				<div class="row">
	            					<div class="col-md-4">
	            						<small>Principal&nbsp;</small>
	            						<input type="color"  id="txt_coloresedit1" name="txt_coloresedit1">
	            					</div>
	            					<div class="col-md-4">
	            						<small>Dashboard 1&nbsp;</small>
	            						<input type="color"  id="txt_coloresedit2" name="txt_coloresedit2">
	            					</div>
	            					<div class="col-md-4">
	            						<small>Dashboard 2&nbsp;</small>
	            						<input type="color"  id="txt_coloresedit3" name="txt_coloresedit3">
	            					</div>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Imagen Logo<br><small class="text-theme">Extensiones: .jpg, .png, .jpeg</small></label>
	            				<div class="input-group">
									<input type="file" id="txt_logoedit" name="txt_logoedit" onchange="archivo()">
									<input type="hidden" id="txt_logo" name="txt_logo">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Imagen Fondo<br><small class="text-theme">Extensiones: .jpg, .png, .jpeg</label>
	            				<div class="input-group">
									<input type="file"  id="txt_fondoedit" name="txt_fondoedit" onchange="archivo()">
									<input type="hidden" id="txt_fondo" name="txt_fondo">
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
	.btn-sm{
	    font-size: 0.8rem;
	}

	@media (min-width: 768px){
		.padding{
			max-width: 40%;
			display: inline-flex;
		}
	}

	@media only screen and (min-width: 1100px){
		.cd-horizontal-timeline {
			margin: 0.8em auto;
		}
	}

	
</style>
<script type="text/javascript">
	
$(function($){

	var cont=0;
	
	var timelines = $('.cd-horizontal-timeline'),
		eventsMinDistance = 60;

	(timelines.length > 0) && initTimeline(timelines);

	function initTimeline(timelines) {
		timelines.each(function(){
			var timeline = $(this),
				timelineComponents = {};
			//cache timeline components 
			timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
			timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
			timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
			timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
			timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
			timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
			timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
			timelineComponents['eventsContent'] = timeline.children('.events-content');

			//assign a left postion to the single events along the timeline
			setDatePosition(timelineComponents, eventsMinDistance);
			//assign a width to the timeline
			var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
			//the timeline has been initialize - show it
			timeline.addClass('loaded');

			//detect click on the next arrow
			timelineComponents['timelineNavigation'].on('click', '.next', function(event){
				event.preventDefault();
				updateSlide(timelineComponents, timelineTotWidth, 'next');
			});
			//detect click on the prev arrow
			timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
				event.preventDefault();
				updateSlide(timelineComponents, timelineTotWidth, 'prev');
			});
			//detect click on the a single event - show new event content
			timelineComponents['eventsWrapper'].on('click', 'a', function(event){
				event.preventDefault();
				timelineComponents['timelineEvents'].removeClass('selected');
				$(this).addClass('selected');
				updateOlderEvents($(this));
				updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
				updateVisibleContent($(this), timelineComponents['eventsContent']);
			});

			//on swipe, show next/prev event content
			timelineComponents['eventsContent'].on('swipeleft', function(){
				var mq = checkMQ();
				( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
			});
			timelineComponents['eventsContent'].on('swiperight', function(){
				var mq = checkMQ();
				( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
			});

			//keyboard navigation
			$(document).click(function(event){
				if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
					showNewContent(timelineComponents, timelineTotWidth, 'prev');
				} else if( event.which=='39' && elementInViewport(timeline.get(0))) {
					showNewContent(timelineComponents, timelineTotWidth, 'next');
				} 
			});
		});
	}

	function updateSlide(timelineComponents, timelineTotWidth, string) {
		//retrieve translateX value of timelineComponents['eventsWrapper']
		var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
			wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
		//translate the timeline to the left('next')/right('prev') 
		(string == 'next') 
			? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
			: translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
	}

	function showNewContent(timelineComponents, timelineTotWidth, string) {
		//go from one event to the next/previous one
		var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
			newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

		if ( newContent.length > 0 ) { //if there's a next/prev event - show it
			var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
				newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
			
			updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
			updateVisibleContent(newEvent, timelineComponents['eventsContent']);
			newEvent.addClass('selected');			
			selectedDate.removeClass('selected');
			updateOlderEvents(newEvent);
			updateTimelinePosition(string, newEvent, timelineComponents, timelineTotWidth);
		}
	}

	function updateTimelinePosition(string, event, timelineComponents, timelineTotWidth) {
		//translate timeline to the left/right according to the position of the selected event
		var eventStyle = window.getComputedStyle(event.get(0), null),
			eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
			timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
			timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
		var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

        if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
        	translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
        }
	}

	function translateTimeline(timelineComponents, value, totWidth) {
		var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
		value = (value > 0) ? 0 : value; //only negative translate value
		value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
		setTransformValue(eventsWrapper, 'translateX', value+'px');
		//update navigation arrows visibility
		(value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
		(value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
	}

	function updateFilling(selectedEvent, filling, totWidth) {
		//change .filling-line length according to the selected event
		var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
			eventLeft = eventStyle.getPropertyValue("left"),
			eventWidth = eventStyle.getPropertyValue("width");
		eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
		var scaleValue = eventLeft/totWidth;
		setTransformValue(filling.get(0), 'scaleX', scaleValue);
	}

	function setDatePosition(timelineComponents, min) {
		for (i = 0; i < timelineComponents['timelineDates'].length; i++) { 
		    var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
		    	distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
		    timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
		}
	}

	function setTimelineWidth(timelineComponents, width) {
		var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
			timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
			timeSpanNorm = Math.round(timeSpanNorm) + 4,
			totalWidth = timeSpanNorm*width;
		timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
		updateFilling(timelineComponents['timelineEvents'].eq(0), timelineComponents['fillingLine'], totalWidth);
	
		return totalWidth;
	}

	function updateVisibleContent(event, eventsContent) {
		var eventDate = event.data('date'),
			visibleContent = eventsContent.find('.selected'),
			selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
			selectedContentHeight = selectedContent.height();

		if (selectedContent.index() > visibleContent.index()) {
			var classEnetering = 'selected enter-right',
				classLeaving = 'leave-left';
		} else {
			var classEnetering = 'selected enter-left',
				classLeaving = 'leave-right';
		}

		selectedContent.attr('class', classEnetering);
		visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
			// visibleContent.removeClass('leave-right leave-left');
			// selectedContent.removeClass('enter-left enter-right');
		});
		eventsContent.css('height', selectedContentHeight+'px');
	}

	function updateOlderEvents(event) {
		event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
	}

	function getTranslateValue(timeline) {
		var timelineStyle = window.getComputedStyle(timeline.get(0), null),
			timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
         		timelineStyle.getPropertyValue("-moz-transform") ||
         		timelineStyle.getPropertyValue("-ms-transform") ||
         		timelineStyle.getPropertyValue("-o-transform") ||
         		timelineStyle.getPropertyValue("transform");

        if( timelineTranslate.indexOf('(') >=0 ) {
        	var timelineTranslate = timelineTranslate.split('(')[1];
    		timelineTranslate = timelineTranslate.split(')')[0];
    		timelineTranslate = timelineTranslate.split(',');
    		var translateValue = timelineTranslate[4];
        } else {
        	var translateValue = 0;
        }

        return Number(translateValue);
	}

	function setTransformValue(element, property, value) {
		element.style["-webkit-transform"] = property+"("+value+")";
		element.style["-moz-transform"] = property+"("+value+")";
		element.style["-ms-transform"] = property+"("+value+")";
		element.style["-o-transform"] = property+"("+value+")";
		element.style["transform"] = property+"("+value+")";
	}

	
	function parseDate(events) {
		var dateArrays = [];
		events.each(function(){
			var dateComp = $(this).data('date').split('/'),
				newDate = new Date(dateComp[2], dateComp[1]-1, dateComp[0]);
			dateArrays.push(newDate);
		});
	    return dateArrays;
	}

	function parseDate2(events) {
		var dateArrays = [];
		events.each(function(){
			var singleDate = $(this),
				dateComp = singleDate.data('date').split('T');
			if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
				var dayComp = dateComp[0].split('/'),
					timeComp = dateComp[1].split(':');
			} else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
				var dayComp = ["2000", "0", "0"],
					timeComp = dateComp[0].split(':');
			} else { //only DD/MM/YEAR
				var dayComp = dateComp[0].split('/'),
					timeComp = ["0", "0"];
			}
			var	newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
			dateArrays.push(newDate);
		});
	    return dateArrays;
	}

	function daydiff(first, second) {
	    return Math.round((second-first));
	}

	function minLapse(dates) {
		//determine the minimum distance among events
		var dateDistances = [];
		for (i = 1; i < dates.length; i++) { 
		    var distance = daydiff(dates[i-1], dates[i]);
		    dateDistances.push(distance);
		}
		return Math.min.apply(null, dateDistances);
	}


	function elementInViewport(el) {
		var top = el.offsetTop;
		var left = el.offsetLeft;
		var width = el.offsetWidth;
		var height = el.offsetHeight;

		while(el.offsetParent) {
		    el = el.offsetParent;
		    top += el.offsetTop;
		    left += el.offsetLeft;
		}

		return (
		    top < (window.pageYOffset + window.innerHeight) &&
		    left < (window.pageXOffset + window.innerWidth) &&
		    (top + height) > window.pageYOffset &&
		    (left + width) > window.pageXOffset
		);
	}

	function checkMQ() {
		//check if mobile or desktop device
		return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
	}
});

$('.dropify').dropify();

$(".dropify-message span").removeAttr("class").html('<div class="ecom-widget-sales"><div class="ecom-sales-icon text-center"><i class="mdi mdi-image-area-close"></i></div></div>');

function archivo(){
	if(document.getElementById("txt_fondoedit").value!=""){
		document.getElementById("txt_fondo").value="t6t6";
	}
	if(document.getElementById("txt_logoedit").value!=""){
		document.getElementById("txt_logo").value="t6t6";
	}
}
</script>
