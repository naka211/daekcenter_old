<?php defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript" src="<? echo $this->template_dir; ?>Scripts/mootools1.2b.js"></script>
  <div class="bg_tr">
    <p class="title_2 m20l p30t">Nyheder</p>
  </div>
  <div class="bg_cr h515" style="height:510px">
    <div class="m20l m20r">
      <div id="content1">
        <? for($i=0; $i<count($this->rows); $i++){ 
			$row = $this->rows[$i];
		?>		  
        <p class="p15t"> <b><? echo $row->title; ?></b><span class="text_day"> (<? echo substr($row->created, 0, 10); ?>)</span><br />
          <? echo short_text($row->introtext, 150); ?></p><span class="text_more"><a href="index.php?option=com_nyheder&view=detail&id=<? echo $row->id; ?>">Læs mere</a></span> 
		<? } ?>
      </div>
      <div id="scrollbar1" class="scrollbar-vert">
        <div id="handle1" class="handle-vert"></div>
      </div>
      <!--<div class="roll" style="height:410px;">
                <a href="#"><img src="img/icon_roll.jpg" /></a>
            </div>-->
      <div class="clear_left"></div>
      <!--end .table_limiter-->      
	  {module Acajoom Subscriber Module}
    </div>
  </div>
  <div class="bg_br"></div>
<script type="text/javascript">
            /* <![CDATA[ */
            
            function makeScrollbar(content,scrollbar,handle,horizontal,ignoreMouse){
                var steps = (horizontal?(content.getScrollSize().x - content.getSize().x):(content.getScrollSize().y - content.getSize().y))
				if(steps <=0)
				{
					scrollbar.style.visibility = 'hidden';
					return;
				}
                var slider = new Slider(scrollbar, handle, {	
                    steps: steps,
                    mode: (horizontal?'horizontal':'vertical'),
                    onChange: function(step){
                        // Scrolls the content element in x or y direction.
                        var x = (horizontal?step:0);
                        var y = (horizontal?0:step);
                        content.scrollTo(x,y);
                    }
                }).set(0);
                if( !(ignoreMouse) ){
                    // Scroll the content element when the mousewheel is used within the 
                    // content or the scrollbar element.
                    $$(content, scrollbar).addEvent('mousewheel', function(e){	
                        e = new Event(e).stop();
                        var step = slider.step - e.wheel * 30;	
                        slider.set(step);					
                    });
                }
                // Stops the handle dragging process when the mouse leaves the document body.
                $(document.body).addEvent('mouseleave',function(){slider.drag.stop()});
            }
                        
            window.addEvent('domready', function(){				
                // -- first example, vertical scrollbar --
                makeScrollbar( $('content1'), $('scrollbar1'), $('handle1') );
            });
            /* ]]> */
        </script>