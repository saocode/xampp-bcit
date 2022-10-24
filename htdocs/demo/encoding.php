<?php include "headerScript.php";?>

<div class="w3-container" style="">

<h1>Unicode</h1>
<p>
	<b>Unicode</b> is a global standard that computers use to display <b>characters</b>.


<p>
	Unicode is based on <b>ASCII</b>. In 1963, ASCII assigned numerical
	values to the keys on a mechanical typewriter.
<p>
	The first printable ASCII character is the <b>space</b>. It is <b>#32</b>.
	The last is the <b>~</b> character. It is <b>#126</b>.
<p>This tool shows the characters assigned to specific numbers. For
	example - try 32 to 126 to see all the ASCII characters.
<hr>
<h2>Unicode Value -> Character</h2>

<form action="tools/encodingTool.php" method="post">
	<input type="hidden" name="webFunction" value="range">
	<p>
		Start:&nbsp <input class="w3-button w3-white w3-border w3-round-large"
			class="w3-margin-top w3-block w3-button w3-white w3-border w3-round-large"
			style="width: 100px" type="text" name="start" required>&nbsp End:
		&nbsp <input class="w3-button w3-white w3-border w3-round-large"
			style="width: 100px" type="text" name="end" required>&nbsp
		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>
<hr>
<h1>Code Points</h1>
<p>
	These examples are <b>all</b> Unicode characters. <b>Some</b> of them
	are also ASCII characters.
<p>
	All Unicode and ASCII characters have a specific <b>code point</b> - a
	numeric value that corresponds to the character.
<p>Use this tool to look up the code points for the characters. Note how
	it will not work with the cigarette character. More on this later.
<h2>Character -> Unicode Value</h2>
<form action="tools/encodingTool.php" method="post">
	<input type="hidden" name="webFunction" value="char">
	<p>
		<input 
		class="w3-button w3-white w3-border w3-round-large"
			style="width: 100px" 
			type="text" name="webString" required
			maxlength="1"> &nbsp
		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>
<h2>Example Characters</h2>
<div style="width: 600px;"margin-left:16px">
	<table class="w3-table w3-striped">
		<tr>
			<th>Character</th>
			<th>Description</th>
		</tr>
		<tr>
			<td>S</td>
			<td>The Latin letter <b>"S"</b>.
			</td>
		</tr>
		<tr>
			<td>Ŝ</td>
			<td>The Latin letter <b>"S"</b> with a <b>circumflex accent</b>.
			</td>
		</tr>

		<tr>
			<td>e</td>
			<td>The Latin letter <b>"e"</b>.
			</td>
		</tr>
		<tr>
			<td>е</td>
			<td>The Cyrillic letter <b>"е"</b>.
			</td>
		</tr>
		<tr>
			<td>™</td>
			<td>The <b>"trademark"</b> symbol.
			</td>
		</tr>
		<tr>
			<td>⛳</td>
			<td>The <b>"golf"</b> emoji.
			</td>
		</tr>
		<tr>
			<td>🚬</td>
			<td>The <b>"cigarette"</b> emoji.
			</td>
		</tr>
	</table>
</div>
<hr>
<h1>e vs. е</h1>
<p>Obviously the S and the Ŝ are different characters. You can use your
	eyes to determine that.
<p>What about the e's? Visually they are the same. But the lookup tool
	you will see that they have different code points. So they are not the
	same.
<div style="width: 600px;"margin-left:16px">
	<table class="w3-table w3-striped">
		<tr>
			<th>Character</th>
			<th>Description</th>
			<th>Unicode Code Point</th>
			<th>HTML Encoding</th>
		</tr>
		<tr>
			<td>S</td>
			<td>The Latin letter <b>"S"</b>.
			</td>
			<td>U+53</td>
			<td>&amp#0x53</td>
		</tr>
		<tr>
			<td>Ŝ</td>
			<td>The Latin letter <b>"S"</b> with a <b>circumflex accent</b>.
			</td>
			<td>U+15c</td>
			<td>&amp#0x15c</td>
		</tr>
		<tr>
			<td>e</td>
			<td>The Latin letter <b>"e"</b>.
			</td>
			<td>U+65</td>
			<td>&amp#0x65</td>
		</tr>
		<tr>
			<td>е</td>
			<td>The Cyrillic letter <b>"е"</b>.
			</td>
			<td>U+435</td>
			<td>&amp#0x435</td>
		</tr>
		<tr>
			<td>™</td>
			<td>The <b>"trademark"</b> symbol.
			</td>
			<td>U+2122</td>
			<td>&amp#0x2122</td>
		</tr>
		<tr>
			<td>⛳</td>
			<td>The <b>"golf"</b> emoji.
			</td>
			<td>U+26f3</td>
			<td>&amp#0x26f3</td>
		</tr>
		<tr>
			<td>🚬</td>
			<td>The <b>"cigarette"</b> emoji.
			</td>
			<td>U+1f6ac</td>
			<td>&amp#0x1f6ac</td>
		</tr>
	</table>
</div>
<hr>

<section id="string">
<h1>String Length</h1>
<p>This section demonstrates how multi-byte characters can cause
	problems for software.
<p>This tool measures how long a string is. Try it with the example
	strings below.
<form action="tools/stringTool.php" method="post">
	<input type="hidden" name="webFunction" value="length">

	<p>
		Enter Text:&nbsp<input 
		class="w3-button w3-white w3-border w3-round-large"
			style="width: 100px" type="text" name="webText" required>&nbsp
	
	

		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>
<hr>
<h1>Example Strings</h1>
<div style="width: 100px;"margin-left:16px">

	<table class="w3-table w3-striped">



		<tr>
			<td>Steve</td>
		</tr>
		<tr>
			<td>Stеvе</td>
		</tr>
		<tr>
			<td>™</td>
		</tr>
		<tr>
			<td>⛳</td>
		</tr>
		<tr>
			<td>🚬</td>
		</tr>

	</table>
</div>
<hr>
<h1>URL Encoding</h1>
<p>This tool will URL encode a text string entered here:
<form action="tools/encodingTool.php" method="post">
	<input type="hidden" name="webFunction" value="url">
	<p>
		http://&nbsp<input 	class="w3-button w3-white w3-border w3-round-large"
			style="width: 300px" type="text" name="webString" required>&nbsp
		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>
<hr>

<h1>Base64 Encoding</h1>
<p>This tool will Base64 encode a text string entered here:
<form action="tools/encodingTool.php" method="post">
	<input type="hidden" name="webFunction" value="base64e">
	<p>
		<input 	class="w3-button w3-white w3-border w3-round-large"
			style="width: 300px" type="text" name="webString" required>&nbsp
		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>

<hr>

<h1>Base64 Decoding</h1>
<p>This tool will decode a Base64 string entered here:
<form action="tools/encodingTool.php" method="post">
	<input type="hidden" name="webFunction" value="base64d">
	<p>
		<input 	class="w3-button w3-white w3-border w3-round-large"
			style="width: 300px" type="text" name="webString" required>&nbsp
		<button class="w3-button w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>


<?php include $footerFile; ?>