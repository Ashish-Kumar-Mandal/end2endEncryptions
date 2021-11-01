const reload = (reloadPeriod)=>{	// reload whole page.
	setTimeout(()=>{
		location.reload(true);
	}, reloadPeriod);
}

const numbers = (id='')=>{	// allow only digits.
	const e = window.event;
	const input = document.getElementById(id);

	if(e.which>=48 && e.which<=57){
		(input.value=='') ? `` : input.style.cssText = 'outline:none; border:2px solid #0f0; border-radius:3px;';
		return true;
	}else{
		(input.value=='') ? `` : input.style.cssText = 'outline:none; border:2px solid #f00; border-radius:3px;';
		return false;
	}
}

const names = (id='')=>{	// allow only alphabets, underscore and space.
	const e = window.event;
	const input = document.getElementById(id);
	
	if((e.which>=65 && e.which<=90) || (e.which>=97 && e.which<=122) || e.which==95 || e.which==32 || e.which==8){
		(input.value=='') ? `` : input.style.cssText = 'outline:none; border:2px solid #0f0; border-radius:3px;';
		return true;
	}else{
		(input.value=='') ? `` : input.style.cssText = 'outline:none; border:2px solid #f00; border-radius:3px;';
		return (e.which==7);
	}
}

const lengths = (selector, length)=>{	// return valid length of strings.
	return true;
}

document.onkeydown = (e)=> {	// dissabled ctrl button.
    if (e.ctrlKey) {
        return false;
    }
};

document.oncontextmenu = ()=>{	// dissabled right click.
	return false;
}