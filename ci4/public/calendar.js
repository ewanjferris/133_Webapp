let calendar = document.querySelector('.calendar')

	const month_names = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember']

	isLeapYear = (year) => {
		return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 ===0)
	}

	getFebDays = (year) => {
		return isLeapYear(year) ? 29 : 28
	}

	generateCalendar = (month, year) => {

		let calendar_days = calendar.querySelector('.calendar-days')
		let calendar_header_year = calendar.querySelector('#year')

		let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

		calendar_days.innerHTML = ''

		let currDate = new Date()
		if (month > 11 || month < 0) month = currDate.getMonth()
		if (!year) year = currDate.getFullYear()

		let curr_month = `${month_names[month]}`
		month_picker.innerHTML = curr_month
		calendar_header_year.innerHTML = year

		// get first day of month
		
		let first_day = new Date(year, month, 1)

		for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
			let day = document.createElement('div')
			if (i >= first_day.getDay()) {
				day.classList.add('calendar-day-hover')
				day.innerHTML = i - first_day.getDay() + 1
				day.classList.add("p" + day.innerHTML)
				day.setAttribute("id", day.innerHTML)
				day.innerHTML += `<span></span>
								<span></span>
								<span></span>
								<span></span>`
				if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
					day.classList.add('curr-date')
				}
			}
			calendar_days.appendChild(day)
		}
		clickable_days();
	}

	let month_list = calendar.querySelector('.month-list')

	month_names.forEach((e, index) => {
		let month = document.createElement('div')
		month.innerHTML = `<div data-month="${index}">${e}</div>`
		month.querySelector('div').onclick = () => {
			month_list.classList.remove('show')
			curr_month.value = index
			generateCalendar(index, curr_year.value)
			//clickable_days();
		}
		month_list.appendChild(month)
	})

	let month_picker = calendar.querySelector('#month-picker')

	month_picker.onclick = () => {
	month_list.classList.add('show')
	}

	let currDate = new Date()
	//let curr_month = {value: currDate.getMonth()}

	let curr_month = {value: localStorage.getItem('ls_selected_month')-1}
	let curr_year = {value: localStorage.getItem('ls_selected_year')}

	generateCalendar(curr_month.value, curr_year.value)
	//clickable_days();

	document.querySelector('#prev-year').onclick = () => {
		--curr_year.value
		generateCalendar(curr_month.value, curr_year.value)
		//clickable_days();
	}

	document.querySelector('#next-year').onclick = () => {
		++curr_year.value
		generateCalendar(curr_month.value, curr_year.value)
		//clickable_days();
	}

	/*-------------------------------------------- show/hide create_post_div*/
	let toggle = button => {
		let element = document.getElementById("create_post_div");
		let hidden = element.getAttribute("hidden");

		if (hidden) {
		element.removeAttribute("hidden");
		button.innerText = "Schliessen";
		} else {
		element.setAttribute("hidden", "hidden");
		button.innerText = "Zeit erfassen";
		}
	}

	row_nr = 0;
	var edit_entries = document.querySelectorAll('.edit_btn');
	edit_entries.forEach(function(edit_entry) {
		edit_entry.classList.add("edit_row_" + row_nr)
		
		let time_div = (document.querySelectorAll(".time_div"))[row_nr];
		let edit_time_div = (document.querySelectorAll(".edit_time_div"))[row_nr];
		let content_div = (document.querySelectorAll(".content_div"))[row_nr];
		let textarea_div = (document.querySelectorAll(".edit_content_textarea"))[row_nr];
		let hidden_textarea_div = textarea_div.getAttribute("hidden")
		let edit_content_btns = (document.querySelectorAll(".edit_content_btns"))[row_nr];
		let cancel_content_btn = (document.querySelectorAll(".cancel_btn"))[row_nr];

		//for reset function
		let content_div_value = (document.querySelectorAll(".content_div"))[row_nr];
		let edit_textarea =  (document.querySelectorAll(".edit_textarea"))[row_nr];
		let time_from_value = (document.querySelectorAll(".time_from"))[row_nr];
		let edit_time_from = (document.querySelectorAll(".edit_time_from"))[row_nr];
		let time_to_value = (document.querySelectorAll(".time_to"))[row_nr];
		let edit_time_to = (document.querySelectorAll(".edit_time_to"))[row_nr];
		row_nr++;

		console.log(textarea_div.classList[0])
		edit_entry.addEventListener('click',function() {
			//show edit view
			if (hidden_textarea_div =="") {
				time_div.setAttribute("hidden", "hidden");
				edit_time_div.removeAttribute("hidden");
				content_div.setAttribute("hidden", "hidden");
				textarea_div.removeAttribute("hidden");
				edit_content_btns.removeAttribute("hidden");
				cancel_content_btn.removeAttribute("hidden");
				edit_entry.setAttribute("hidden", "hidden");
			} 
			//cancel
			cancel_content_btn.onclick = function() {
				//toggle view from edit view to normal view
				time_div.removeAttribute("hidden");
				edit_time_div.setAttribute("hidden", "hidden");
				content_div.removeAttribute("hidden");
				textarea_div.setAttribute("hidden", "hidden");
				edit_content_btns.setAttribute("hidden", "hidden");
				cancel_content_btn.setAttribute("hidden", "hidden");
				edit_entry.removeAttribute("hidden");

				//reset textarea
				let original_value = content_div_value.innerText;
				edit_textarea.value =original_value
				//reset time_from
				edit_time_from.value = time_from_value.value
				//reset time_to
				edit_time_to.value = time_to_value.value
			 };
		})
	});
	

/*----------------------------------------------------------------------------reset value to original*/ 	
function reset_to_original(){
	//reset textarea
	let textarea = document.getElementById("edit_textarea");
	let content_div_value = document.getElementById("content_div");
	content_div_value = content_div_value.trim();
	let original_value = content_div_value;
	textarea.value = original_value;

	//reset time from
	let edit_time_from = document.getElementById("edit_time_from");
	let time_from_original = document.getElementById("time_from").value;
	edit_time_from.value = time_from_original;

	//reset time to
	let edit_time_to = document.getElementById("edit_time_to");
	let time_to_original = document.getElementById("time_to").value;
	edit_time_to.value = time_to_original;

	//toggle back to normal view (from edit view)
	
}
/*----------------------------------------- change date by clicking on date */

function clickable_days(){

var day_divs = document.querySelectorAll('.calendar-day-hover');
	day_divs.forEach(function(day_div) {  

	day_div.addEventListener('click',function() {
		//saves selected date to var and edits if necessary
		selected_date = day_div.id;
		sel_date_without_0 = day_div.id;
		if (selected_date <=9 ){
			selected_date = "0"+ selected_date
		}
		console.log("selected_date : " +selected_date);  
		
		$(this).addClass("bordered_date");
		localStorage.setItem('activeArea',1);
		localStorage.setItem('ls_selected_date',sel_date_without_0);
		
		var selected_year = document.getElementById("year").innerText
		var selected_month_name = document.getElementById("month-picker").innerText
		localStorage.setItem('ls_selected_year',selected_year);
		switch (selected_month_name) {
		case 'Januar':
		selected_month = '01';
		break;
		case 'Februar':
		selected_month = '02';
		break; 
		case 'März':
		selected_month = '03';
		break;
		case 'April':
		selected_month = '04';
		break;
		case 'Mai':
		selected_month = '05';
		break;
		case 'Juni':
		selected_month = '06';
		break;
		case 'Juli':
		selected_month = '07';
		break;
		case 'August':
		selected_month = '08';
		break;
		case 'September':
		selected_month = '09';
		break;
		case 'Oktober':
		selected_month = '10';
		break;
		case 'November':
		selected_month = '11';
		break;
		case 'Dezember':
		selected_month = '12';
		break;
		default:
		console.log(`-------Month name error`);
		}
		localStorage.setItem('ls_selected_month',selected_month);
		/*---------------------------------------sets Value of date and submits form*/
		document.getElementById('datepicker').value= selected_year+"-"+selected_month+"-"+selected_date;
		console.log("full selected date: " + selected_year+"-"+selected_month+"-"+selected_date);
		$('#date_form').submit();
	})
		
	});
}
	/*------------- add border class (from localStorage)*/    
	window.onload = function () {
	console.log("ls_selected_date: " + localStorage.getItem('ls_selected_date'));
	var day_border = document.querySelector('.p'+ localStorage.getItem('ls_selected_date'));
	
	if( localStorage.getItem('activeArea')==1){
		//$(day_border).addClass("bordered_date");
		day_border.classList.add("bordered_date")
	} 
	console.log("day_border: " + day_border);
	console.log("activeArea : " + localStorage.getItem('activeArea'));
	console.log("ls_selected_date: " + localStorage.getItem('ls_selected_date'));
	}
	log_out_btn = document.querySelector(".btn-danger")
	log_out_btn.onclick = function() {
		const date = new Date();
		let day = date.getDate();
		let month = date.getMonth() + 1;
		let year = date.getFullYear();
		let currentDate = `${year}-${month}-${day}`;
		console.log(currentDate)
		//removes localStorage items
		localStorage.removeItem("activeArea");
		//sets Date to current Date (default)
		localStorage.setItem("ls_selected_date", day );
		console.log("--------currentDate : "+currentDate)
	};