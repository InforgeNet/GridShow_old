function if_gs_set_classes(tiles, pattern)
{
	var spans = pattern.split(" ", tiles.length);
	var i = 0;
	tiles.each(function() {
		if (i >= spans.length)
			return;
		var cur_spans = spans[i].split(",", 2);
		for (var j = 0; j < cur_spans.length; j++)
			$(this).addClass("if-gs-tile-span" + cur_spans[j]);
		i++;
	});
}

function if_gs_arrange_tiles()
{
	var widget = $(".if-gs-widget");
	widget.hide();
	var tiles = widget.children(".if-gs-tile");
	var pattern = "";
	switch (tiles.length) {
	case 0:
		return;
	case 1:
		pattern = "4h,3v";
		break;
	case 2:
		pattern = "2h,3v 2h,3v";
		break;
	case 3:
		pattern = "2h,2v 2h,2v 4h";
		break;
	case 4:
		pattern = "2h,2v 2h,2v 2h 2h";
		break;
	case 5:
		pattern = "2h,2v 2h 2h 2h 2h";
		break;
	case 6:
		pattern = "2h,2v 2h 2h 2h";
		break;
	case 7:
		pattern = "2h,2v 2h 2h";
		break;
	case 8:
		pattern = "2h,2v 2h";
		break;
	case 9:
		pattern = "2h,2v";
		break;
	case 10:
		pattern = "2h 2h";
		break;
	case 11:
		pattern = "2h";
		break;
	default:
		widget.show();
		return;
	}
	if_gs_set_classes(tiles, pattern);
	widget.show();
}
