/**==============================================
*	Hours Processor
* 		Version 1.0
*		Author: Josh Bielick
* 		Date: 1/25/2013
*		fragmentlabs.com
*
*==============================================*/
var Hours = 
{
	displayId: 'display',
	jsonDump: 'output',
	begHoursId: 'begHours',
	endHoursId: 'endHours',
	dayButtonsClass: 'day pressed',
	
	init: function()
	{
		this.display();
	},
	get: function()
	{
		try {
			var hoursObj = (typeof window.localStorage.hours == 'undefined') ? JSON.parse(document.getElementById(this.jsonDump).innerText) : JSON.parse(window.localStorage.hours);
		}
		catch(e)
		{
			console.log(e+'; no currently set hours. Continuing...');
			var hoursObj = {};
		}
		return hoursObj;
	},
	decodeTime: function(hour)
	{
		var tDay = (hour < 1200 || hour >= 2400 ) ? ' AM' : ' PM',
			halfHour,
			formattedHour;
			
		hourStr = (typeof hour != 'string' ) ? ''+hour+'' : hour;
		hourArr = hourStr.split('');
		
		if( hourArr.length == 3 )
		{
			switch(hourArr[1])
			{
				case '0': halfHour = ''; break;
				case '3': halfHour = ':30'; break;
				case '1': halfHour = ':15'; break;
				case '4': halfHour = ':45'; break;
			}
			hourArr[0] =  ( hourArr[0] == 0 ) ? '12' : hourArr[0];
			formattedHour = hourArr[0]+halfHour;
		}
		else if( hourArr.length == 4 )
		{
			switch(hourArr[2])
			{
				case '0': halfHour = ''; break;
				case '3': halfHour = ':30'; break;
				case '1': halfHour = ':15'; break;
				case '4': halfHour = ':45'; break;
			}
			if( parseInt(hour.slice(0,2),10) > 12 )
				formattedHour = ( hour.slice(0,2) - 12 )+halfHour;
			if( parseInt(hour.slice(0,2),10) <= 12 )
				formattedHour = hourArr[0]+hourArr[1]+halfHour;
		}
		return formattedHour+tDay;
	},
	decodeDay: function(day)
	{
		switch(day)
		{
			case '6': dow = 'Sunday'; 	break;
			case '0': dow = 'Monday';	break;
			case '1': dow = 'Tuesday';	break;
			case '2': dow = 'Wednesday';break;
			case '3': dow = 'Thursday'; break;
			case '4': dow = 'Friday';	break;
			case '5': dow = 'Saturday';	break;
			case '-': dow = ' - ';		break;
			default:  dow = '?';		break;
		}
		return dow;
	},
	display: function(hours)
	{
		if ( typeof hours == 'undefined' )
			hours = this.get();
		else if ( hours.constructor.name != 'Object' )
			return false;
			
		console.log('Displayed hours: '+JSON.stringify(hours, null, '\t'));
		
		var yesterday,
			combinedDays = [],
			hoursPrintout = [],
			daysToPrint,
			toDelete = {},
			foundLikeHours,
			today,
			currentDay,
			tomorrow,
			dow;
			
		document.getElementById(this.jsonDump).innerText = JSON.stringify(hours, null, '\t');
			
		for(day in hours)
		{
			if (hours.hasOwnProperty(day))
			{
				foundLikeHours = false;
				for (var i=0; i < combinedDays.length; i++) {
					if(objectsAreSame(combinedDays[i].hours, hours[day]))
					{
						combinedDays[i].days.push(day);
						foundLikeHours = true;
						combinedDays[i].daysArr = combinedDays[i].days.join(',');
					}
				};
				console.log(combinedDays);
				if(!foundLikeHours)
				{
					combinedDays.push({
						'days': [day],
						'hours': hours[day],
						'daysArr': day,
						'span': false,
					});
				}
			}
		};
		for (var j = combinedDays.length - 1; j >= 0; j--)
		{
			var numDays = combinedDays[j].days.length;
			if ( numDays > 2 )
			{
				for (var d = numDays - 1; d >= 0; d--) {
					if ( d - 2 >= 0 )
					{
						today = parseInt(combinedDays[j].days[d], 10);
						var z = 2;
						while (z <= numDays)
						{
							if ( today-z == parseInt( combinedDays[j].days[d-z], 10) )
							{
								if (z == 2)
								{
									combinedDays[j].days[d-1] = '-';
									combinedDays[j].span = {
										'start': d-z,
										'end': d
									};
								}
								else
								{
									combinedDays[j].days.splice(d-(z-1), 1);
									combinedDays[j].span.start = d-(z);
								}
							}
							z++;
						}
					}
				};
			}
		};
		for (var i=0; i < combinedDays.length; i++)
		{
			daysToPrint = '';
			for (var j=0; j < combinedDays[i].days.length; j++) 
			{
				currentDay = this.decodeDay(combinedDays[i].days[j]),
				tomorrow = this.decodeDay(combinedDays[i].days[j+1]),
				yesterday = this.decodeDay(combinedDays[i].days[j-1]);
				if ( j == 0 )
					daysToPrint += currentDay;
				else if ( j == 0 && tomorrow == ' - ' || currentDay == ' - ' || yesterday == ' - ')
					daysToPrint += ''+currentDay;
				else if ( j != 0 && tomorrow == ' - ')
					daysToPrint += ' and '+currentDay;
				else if ( j == combinedDays[i].days.length-1 )
					daysToPrint += ' and '+currentDay;
				else
					daysToPrint += ', '+currentDay;
			};
			
			if(combinedDays.length == 1 && combinedDays[0].daysArr.split(',').length == 7)
				daysToPrint = 'Everyday';
				
			hoursPrintout.push(
								'<div class="hour-entry">'+
								'<span class="hours-day"> '+daysToPrint+'</span>'+
								'<span class="hours-hours"> '+this.decodeTime(combinedDays[i].hours[0])+' - '+this.decodeTime(combinedDays[i].hours[1])+'.</span>'+
								'<a class="delete trans" onclick="Hours.delete(['+combinedDays[i].daysArr+'])">x</a>'+
								'</div>'
							);
		};
		
		document.getElementById(this.displayId).innerHTML = '';

		for (var i=0; i < hoursPrintout.length; i++)
		{
			document.getElementById(this.displayId).innerHTML += hoursPrintout[i];
		};
		return hoursPrintout;
	},
	save: function(hoursObj)
	{
		var json = JSON.stringify(hoursObj, null, '\t');
		document.getElementById(this.jsonDump).innerText = json;
		window.localStorage['hours'] = json;
		this.display(hoursObj);
	},
	add: function()
	{
		var newHours = {},
			currentHours = this.get(),
			day,
			days = document.getElementsByClassName(this.dayButtonsClass),
			from = document.getElementById(this.begHoursId).value,
			to = document.getElementById(this.endHoursId).value;
			
		if( parseInt(from,10) - 12 > parseInt(to,10) || from == to || isNaN(from) || isNaN(to))
		{
			alert('There seems to be something wrong with the hours you\'ve selected. Please check them and try again.');
			return false;
		}
		else
		{
			for (var i=0; i < days.length; i++) 
			{
				encodedDay = days[i].getAttribute('data-day');
				currentHours[encodedDay] = [from, to];
			};
			this.save(currentHours);
			return true;
		}
	},
	delete: function(deleteIndexArray)
	{
		var hours = this.get(),
			toDelete;
			
		if(deleteIndexArray.indexOf(',') >= 0)
			toDelete = deleteIndexArray.split(',');
		else if ( typeof deleteIndexArray == 'object' )
			toDelete = deleteIndexArray;
		
		if(toDelete)
		{
			for (var i = toDelete.length - 1; i >= 0; i--) {
				delete hours[toDelete[i]];
			};
		}
		else
			delete hours[deleteIndexArray];
			
		this.save(hours);
	},
	source: function(hour, direction)
	{
		var where,
		possibleHours = [
			{ value: '000', label: '12:00 AM'},
			{ value: '015', label: '12:15 AM'},
			{ value: '030', label: '12:30 AM'},
			{ value: '045', label: '12:45 AM'},
			{ value: '100', label: '1:00 AM'},
			{ value: '115', label: '1:15 AM'},
			{ value: '130', label: '1:30 AM'},
			{ value: '145', label: '1:45 AM'},
			{ value: '200', label: '2:00 AM'},
			{ value: '215', label: '2:15 AM'},
			{ value: '230', label: '2:30 AM'},
			{ value: '245', label: '2:45 AM'},
			{ value: '300', label: '3:00 AM'},
			{ value: '315', label: '3:15 AM'},
			{ value: '330', label: '3:30 AM'},
			{ value: '345', label: '3:45 AM'},
			{ value: '400', label: '4:00 AM'},
			{ value: '415', label: '4:15 AM'},
			{ value: '430', label: '4:30 AM'},
			{ value: '445', label: '4:45 AM'},
			{ value: '500', label: '5:00 AM'},
			{ value: '515', label: '5:15 AM'},
			{ value: '530', label: '5:30 AM'},
			{ value: '545', label: '5:45 AM'},
			{ value: '600', label: '6:00 AM'},
			{ value: '615', label: '6:15 AM'},
			{ value: '630', label: '6:30 AM'},
			{ value: '645', label: '6:45 AM'},
			{ value: '700', label: '7:00 AM'},
			{ value: '715', label: '7:15 AM'},
			{ value: '730', label: '7:30 AM'},
			{ value: '745', label: '7:45 AM'},
			{ value: '800', label: '8:00 AM'},
			{ value: '815', label: '8:15 AM'},
			{ value: '830', label: '8:30 AM'},
			{ value: '845', label: '8:45 AM'},
			{ value: '900', label: '9:00 AM'},
			{ value: '915', label: '9:15 AM'},
			{ value: '930', label: '9:30 AM'},
			{ value: '945', label: '9:45 AM'},
			{ value: '1000', label: '10:00 AM'},
			{ value: '1015', label: '10:15 AM'},
			{ value: '1030', label: '10:30 AM'},
			{ value: '1045', label: '10:45 AM'},
			{ value: '1100', label: '11:00 AM'},
			{ value: '1115', label: '11:15 AM'},
			{ value: '1130', label: '11:30 AM'},
			{ value: '1145', label: '11:45 AM'},
			{ value: '1200', label: '12:00 PM'},
			{ value: '1215', label: '12:15 PM'},
			{ value: '1230', label: '12:30 PM'},
			{ value: '1245', label: '12:45 PM'},
			{ value: '1300', label: '1:00 PM'},
			{ value: '1315', label: '1:15 PM'},
			{ value: '1330', label: '1:30 PM'},
			{ value: '1345', label: '1:45 PM'},
			{ value: '1400', label: '2:00 PM'},
			{ value: '1415', label: '2:15 PM'},
			{ value: '1430', label: '2:30 PM'},
			{ value: '1445', label: '2:45 PM'},
			{ value: '1500', label: '3:00 PM'},
			{ value: '1515', label: '3:15 PM'},
			{ value: '1530', label: '3:30 PM'},
			{ value: '1545', label: '3:45 PM'},
			{ value: '1600', label: '4:00 PM'},
			{ value: '1615', label: '4:15 PM'},
			{ value: '1630', label: '4:30 PM'},
			{ value: '1645', label: '4:45 PM'},
			{ value: '1700', label: '5:00 PM'},
			{ value: '1715', label: '5:15 PM'},
			{ value: '1730', label: '5:30 PM'},
			{ value: '1745', label: '5:45 PM'},
			{ value: '1800', label: '6:00 PM'},
			{ value: '1815', label: '6:15 PM'},
			{ value: '1830', label: '6:30 PM'},
			{ value: '1845', label: '6:45 PM'},
			{ value: '1900', label: '7:00 PM'},
			{ value: '1915', label: '7:15 PM'},
			{ value: '1930', label: '7:30 PM'},
			{ value: '1945', label: '7:45 PM'},
			{ value: '2000', label: '8:00 PM'},
			{ value: '2015', label: '8:15 PM'},
			{ value: '2030', label: '8:30 PM'},
			{ value: '2045', label: '8:45 PM'},
			{ value: '2100', label: '9:00 PM'},
			{ value: '2115', label: '9:15 PM'},
			{ value: '2130', label: '9:30 PM'},
			{ value: '2145', label: '9:45 PM'},
			{ value: '2200', label: '10:00 PM'},
			{ value: '2215', label: '10:15 PM'},
			{ value: '2230', label: '10:30 PM'},
			{ value: '2245', label: '10:45 PM'},
			{ value: '2300', label: '11:00 PM'},
			{ value: '2315', label: '11:15 PM'},
			{ value: '2330', label: '11:30 PM'},
			{ value: '2345', label: '11:45 PM'},
		];
		
		if (typeof hour == 'undefined')
			return possibleHours;
		else
		{
			for (var i = possibleHours.length - 1; i >= 0; i--){
				if(possibleHours[i].value == hour)
					where = i;
			};
			
			if ( direction == 'after' )
				return possibleHours.splice(where+1, possibleHours.length);
			else
				return possibleHours.splice(0, where);
		}
	}
}	

function objectsAreSame(x, y) {
   var objectsAreSame = true;
   for(var propertyName in x) {
      if(x[propertyName] !== y[propertyName]) {
         objectsAreSame = false;
         break;
      }
   }
   return objectsAreSame;
}
	
	
$(function() 
{	
	Hours.init();
	
	/**==============================================
	*	BINDS
	*==============================================*/
	$('button.day').on('click', function(e)
	{
		$(this).toggleClass('pressed unpressed');
	});
	// 
	// dayButtons = document.getElementsByClassName('button day');
	// for (var i = dayButtons.length - 1; i >= 0; i--){
	// 	var classes = dayButtons[i].className.split(' ')
	// };

	/**==============================================
	*	clear all bind
	*==============================================*/
	$('#clear').on('click', function(e)
	{
		delete window.localStorage['hours'];
		document.getElementById('output').innerText = '';
		Hours.display();
	});

	/**==============================================
	*	add bind
	*==============================================*/
	$('#add').on('click', function(e)
	{
		if($('button.pressed.day').length > 0)
		{
			if(Hours.add())
				$('button.day.pressed').toggleClass('pressed unpressed');
		}
		else
			alert('Please select at least one day that you are open!');
	});
	
	/**
	 *	Prevent Form Submits
	 */
	$('button').on('click', function(e)
	{
		e.preventDefault();
	});
	
	$("#to").on( "keydown", function( event ) {
	        if ( event.keyCode === $.ui.keyCode.TAB ) {
	          event.preventDefault();
	        }
	      }).autocomplete({
		source: Hours.source(),
		minLength: 1,
		select: function(event, ui)
		{
			$("#endHours").val( ui.item.value );
			$("#to").val( ui.item.label );
			return false;
		}
	});
	$("#from").on( "keydown", function( event ) {
	        if ( event.keyCode === $.ui.keyCode.TAB ) {
	          event.preventDefault();
	        }
	      }).autocomplete({
		source: Hours.source(),
		minLength: 0,
		select: function(event, ui)
		{
			$("#begHours").val( ui.item.value );
			$("#from").val( ui.item.label );
			$("#to").autocomplete('option', 'source', Hours.source(''+ui.item.value, 'after'));
			return false;
		}
	});
})