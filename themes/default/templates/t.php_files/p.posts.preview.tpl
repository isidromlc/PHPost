<div id="preview" class="box_cuerpo" style="margin: -15px 0 0; font-size:13px; line-height: 1.4em; width: 750px; padding: 12px 60px; overflow-y: auto; text-align: left">
	{$tsPreview.cuerpo}
</div>
{literal}
<script type="text/javascript">
$(window).on('resize', function(){
		$('#preview').height((document.documentElement.clientHeight - 140) + 'px');
		mydialog.center();
	}
);
$(window).trigger('resize');
</script>
{/literal}