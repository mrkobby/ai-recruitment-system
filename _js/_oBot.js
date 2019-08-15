function chatBot() {
	this.input;
	this.respondTo = function(input) {
	
		this.input = input.toLowerCase();
		
		if(this.match('(hi|hello|hey|hola|howdy)(\\s|!|\\.|$)'))
			return "Hello. How can I help?";
		
		if(this.match('what[^ ]* up') || this.match('sup') || this.match('how are you'))
			return "I'm fine. Thank You";
		
		if(this.match('l(ol)+') || this.match('(ha)+(h|$)') || this.match('lmao'))
			return "what's so funny?";
		
		if(this.match('(cya|bye|see ya|ttyl|talk to you later)'))
			return ["Alright, talk to you later", "I will be right here whenever you need me."];
		
		if(this.match('(dumb|stupid|is that all)'))
			return ["Hey! That's not nice."];
		
		if(this.match('(thanks|thank you)'))
			return ["You're welcome"];
		
		if(this.match('(bacsyd|about the system|about bacsyd)'))
			return ["Bacsyd is a recruitment web-portal that automates the shortlisting process of recruitment. It is intended to help ensure a quality and bias-free selection of candidates, avoid discrimination, save time and money, as well as positively impacting of the organization’s reputation. "];
		
		if(this.match('(apply for jobs|apply for job|apply for a job|get a job)'))
			return ["Go to your jobs page. Search through available jobs. Once you find the one that interests you, click the 'apply for this job' button."];
		
		if(this.match('(help|how can you help)'))
			return ["Try: 'take me to settings page','view notifications','tell me about the system','how do I get a job','log me out'", ];
		
		if(this.match('(profile strength)'))
			return ["The profile strength is an extra feature that tells how strong a job seeker's profile or virtual resume is. It ranges from 4% to 98%", ];
		
		
		if(this.match('(notifications|note|alert|alerts|notes)'))
			return notifications(user());
		if(this.match('(settings)'))
			return settings(user());
		if(this.match('(dashboard|home)'))
			return owlphinhome(user());
		if(this.match('(logout|signout|signoff|sign me off|sign off|log out|sign out)')|| this.match('log me out')|| this.match('sign me out'))
			return logout();

		
		if(this.input == 'noop')
			return;
		//return input + " what?";
		return "...";
	}
	this.match = function(regex) {
	
		return new RegExp(regex).test(this.input);
	}
}
