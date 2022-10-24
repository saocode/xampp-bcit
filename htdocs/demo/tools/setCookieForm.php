<form
	action="tools/cookieTool.php"
	method="post"
>
	<input
		type="hidden"
		name="webFunction"
		value="set"
	> <input
		class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
		type="text"
		placeholder="Cookie Name"
		name="webCookieName"
		required
	> <input
		class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
		type="text"
		placeholder="Cookie Value"
		name="webCookieValue"
		required
	>
	<button
		class="w3-hover-shadow-blue w3-margin-top w3-margin-bottom w3-block w3-btn w3-white w3-border w3-border-blue w3-round-large"
		type="submit"
	><b>Set Cookie</b></button>
</form>