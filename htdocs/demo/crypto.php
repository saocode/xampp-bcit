<?php include "headerScript.php";?>




<ul class="w3-ul w3-border w3-left w3-hover-shadow w3-quarter w3-margin-bottom w3-margin-right">

	<li class="w3-black w3-xlarge w3-padding-32">AES</li>
	<li class="w3-padding-16">
		<h2 class="">Cipher/Decipher:</h2>
		<form
			action="tools/cryptoTool.php"
			method="post"
		>
			<input
				type="hidden"
				name="webFunction"
				value="aes"
			> <input
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
				type="text"
				placeholder="Enter Text String"
				name="webText"
				required
			> <input
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
				type="text"
				placeholder="Enter Key String"
				name="webKey"
				required
			> <input
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
				type="text"
				placeholder="Enter IV String"
				name="webIV"
				optional
			>
			<div
				class="w3-margin-top w3-btn w3-white w3-border w3-round-large"
			>
				<label>
				<input
					type="radio"
					name="webAction"
					value="encrypt"
					required
				> Encrypt 
				
				
				</label>
							</div>
							<div
				class="w3-margin-top w3-btn w3-white w3-border w3-round-large"
			>
				
				<label>
				<input
					type="radio"
					name="webAction"
					value="decrypt"
				> Decrypt</label></div>
			<button
				class="w3-margin-top w3-block w3-margin-right w3-btn w3-white w3-border w3-border-red w3-round-large"
				type="submit"
			>Submit</button>
		</form>
	</li>
	</ul>

<ul class="w3-ul w3-border w3-left w3-hover-shadow w3-quarter w3-margin-bottom w3-margin-right">

	
		<li class="w3-black w3-xlarge w3-padding-32">Hash</li>
	<li class="w3-padding-16">
		<h2 class="">Message:</h2>
		<form
			action="tools/cryptoTool.php"
			method="post"
		>
			<input
				type="hidden"
				name="webFunction"
				value="hash"
			> <input
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
				type="text"
				placeholder="Enter Text String"
				name="webText"
				required
			> <input
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
				type="text"
				placeholder="Enter Salt String"
				name="webSalt"
				
			> 
<h2><label for="webAlgo">Choose a Hash Algorithm:</label></h2><br>
<select name="webAlgo" 
class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
id="webAlgo">
  <option value="md5">MD5</option>
  <option value="sha256">SHA256</option>
  <option value="crc32">CRC32</option>
  required
</select>


			<button
				class="w3-margin-top w3-block w3-btn w3-white w3-border w3-border-red w3-round-large"
				type="submit"
			>Submit</button>
		</form>
	</li>
</ul>

<?php include $footerFile; ?>