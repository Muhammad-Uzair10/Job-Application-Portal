<!DOCTYPE html>
<HTML lang="en">
<?php include 'header.inc' ?>

<?php include 'menu.inc' ?>


    
  <article>
  
  <h2>Apply Here</h2>
  
  <form action="processEOI.php" method="POST" class="form" novalidate="novalidate">
     <fieldset>
	   
	   <legend>Enter Job Reference Number</legend>

	   <label for="jobRef">Job Reference Number (must be same as in job postings e.g;A1B1C)</label>
			<input type="text" name="job" id="job" placeholder="Job Reference No." required="required" pattern="[a-zA-Z0-9]{5}"/>
	 
     </fieldset>
     <br/>	
     <fieldset>
	   <legend>Enter Personal Details</legend>
	   
	     <label for="firstName">First Name</label>
		   <input type="text" name="firstName" id="firstName" required="required" maxlength="20" pattern="[A-Za-z]+"/>
		 <label for="lastName">Last Name</label>
		   <input type="text" name="lastName" id="lastName" required="required" maxlength="20" pattern="[A-Za-z]+"/>
		 <label for="dob">Date of Birth</label>
		   <input type="text" name="dob" id="dob" required="required" pattern="\d{2}/\d{2}/\d{4}"/>  
     </fieldset>
     <br/>
     <fieldset>
	   <legend>Gender</legend>
	   <label>Select your Gender</label>
	        <input type="radio" name="gender" value="male" required="required" /> Male
			<input type="radio" name="gender" value="female" required="required" /> Female
			<input type="radio" name="gender" value="other" required="required" /> Other
     </fieldset>	 
     <br/>
	 <fieldset>
	   <legend>Address of Residence</legend>
	   <div class="info">
	    <label for="streetaddress">Street Address</label>
		<input type="text" name="streetaddress" id="streetaddresss" maxlength="40"  required="required"/> 
		<label for="suburb">Suburb/Town</label>
		<input type="text" name="suburb" id="suburb" maxlength="40"  required="required"/>
		
		<label for="state">State</label>
		  <select name="state" id="state">
		    <option value="">--Select State of Residence--</option>
			<option value="VIC">VIC</option>
			<option value="NSW">NSW</option>
		    <option value="QLD">QLD</option>
			<option value="NT">NT</option>
			<option value="WA">WA</option>
			<option value="SA">SA</option>
			<option value="TAS">TAS</option>
			<option value="ACT">ACT</option>
		  </select>	
		<label for="postcode">Postcode</label>	
		<input type="text" name="postcode" id="postcode" pattern="[0-9]{4}"  required="required"/>  
		</div>
	 </fieldset>
	 <br/>
	 <fieldset>
	   <div class="info">
	   <label for="email">Enter your Email</label>
	   <input type="email" id="email" name="email" required="required"/>
	   <label for="tel">Enter your Telephone Number</label>
	   <input type="tel" id="tel" name="tel"  pattern="[0-9]{8,12}" required="required">
	   </div>
	 </fieldset>
	 <br/>
	 <fieldset>
	  <legend>Which of the programming language skills and skills you experienced in?</legend>
	  <div class="info">
	  <label for="skilllist">Select:</label>
	  <ul>
	    <li><label><input type="checkbox" name="skills[]" value="C">C, C#, Turbo C</label></li>
        <li><label><input type="checkbox" name="skills[]" value="HTML"> HTML</label></li>
        <li><label><input type="checkbox" name="skills[]" value="CSS"> CSS</label></li>
        <li><label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label></li>
		<li><label><input type="checkbox" name="skills[]" value="Python"> Python</label></li>
		<li><label><input type="checkbox" name="skills[]" value="JavaIDE"> JavaIDE</label></li>
		<li><label><input type="checkbox" name="skills[]" value="Ruby">Ruby/RubyonRails</label></li>
		<li><label><input type="checkbox" name="skills[]" value="ArduinoIDE"> ArduinoIDE</label></li>
		<li><label><input type="checkbox" name="skills[]" value="Front-End Dev"> Front-End Development</label></li>
		<li><label><input type="checkbox" name="skills[]" value="Back-End Dev"> Back-End Development</label></li>
       </ul>
	   <label for="other">Other Skills</label>
	   <textarea rows="4" cols="50" name="other" id="other"></textarea>
	   </div>
	 </fieldset>
	 <br/>
	 
	 <button type="submit" class="hover-link primary-button">Apply</button>
	 <button type="reset" class="hover-link secondary-button">Reset</button> 
  </form>
  
  </article>
  <footer>
    <?php include 'footer.inc' ?>
  </footer>
</body>
</html>
