<?php

/**
 * @name      ElkArte Forum
 * @copyright ElkArte Forum contributors
 * @license   BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * This software is a derived product, based on:
 *
 * Simple Machines Forum (SMF)
 * copyright:	2011 Simple Machines (http://www.simplemachines.org)
 * license:  	BSD, See included LICENSE.TXT for terms and conditions.
 *
 * @version 1.0 Alpha
 */

// Editing or adding holidays.
function template_edit_holiday()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show a form for all the holiday information.
	echo '
	<div id="admincenter">
		<form action="', $scripturl, '?action=admin;area=managecalendar;sa=editholiday" method="post" accept-charset="UTF-8">
			<div class="cat_bar">
				<h3 class="catbg">', $context['page_title'], '</h3>
			</div>
			<div class="windowbg">
				<div class="content">
					<dl class="settings">
						<dt class="small_caption">
							<strong>', $txt['holidays_title_label'], ':</strong>
						</dt>
						<dd class="small_caption">
							<input type="text" name="title" value="', $context['holiday']['title'], '" size="55" maxlength="60" />
						</dd>
						<dt class="small_caption">
							<strong>', $txt['calendar_year'], '</strong>
						</dt>
						<dd class="small_caption">
							<select name="year" id="year" onchange="generateDays();">
								<option value="0000"', $context['holiday']['year'] == '0000' ? ' selected="selected"' : '', '>', $txt['every_year'], '</option>';
	// Show a list of all the years we allow...
	for ($year = $modSettings['cal_minyear']; $year <= $modSettings['cal_maxyear']; $year++)
		echo '
								<option value="', $year, '"', $year == $context['holiday']['year'] ? ' selected="selected"' : '', '>', $year, '</option>';

	echo '
							</select>&nbsp;
							', $txt['calendar_month'], '&nbsp;
							<select name="month" id="month" onchange="generateDays();">';

	// There are 12 months per year - ensure that they all get listed.
	for ($month = 1; $month <= 12; $month++)
		echo '
								<option value="', $month, '"', $month == $context['holiday']['month'] ? ' selected="selected"' : '', '>', $txt['months'][$month], '</option>';

	echo '
							</select>&nbsp;
							', $txt['calendar_day'], '&nbsp;
							<select name="day" id="day" onchange="generateDays();">';

	// This prints out all the days in the current month - this changes dynamically as we switch months.
	for ($day = 1; $day <= $context['holiday']['last_day']; $day++)
		echo '
								<option value="', $day, '"', $day == $context['holiday']['day'] ? ' selected="selected"' : '', '>', $day, '</option>';

	echo '
							</select>
						</dd>
					</dl>
					<hr class="hrcolor" />';

	if ($context['is_new'])
		echo '
					<input type="submit" value="', $txt['holidays_button_add'], '" class="button_submit" />';
	else
		echo '
					<input type="submit" name="edit" value="', $txt['holidays_button_edit'], '" class="button_submit" />
					<input type="submit" name="delete" value="', $txt['holidays_button_remove'], '" class="button_submit" />
					<input type="hidden" name="holiday" value="', $context['holiday']['id'], '" />';
	echo '
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
				</div>
			</div>
		</form>
	</div>';
}