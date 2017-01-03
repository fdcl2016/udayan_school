<div class="span12">
    <div class="widget ">
        <div class="widget-header">
            <i class="icon-list-ul"></i>
            <h3>Holiday Management</h3>
        </div>
        <div class="widget-content">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li <?php if($rasel == 1) echo "class='active'";?>>
                        <a href="../holiday_management/create_events">Create Events</a>
                    </li>
                    <li <?php if($rasel == 2) echo "class='active'";?>>
                        <a href="../holiday_management/create_annual_calender">Create Annual Calender</a>
                    </li>
                    <li <?php if($rasel == 3) echo "class='active'";?>>
                        <a href="../holiday_management/show_events">Show Events</a>
                    </li>
                    <li <?php if($rasel == 4) echo "class='active'";?>>
                        <a href="../holiday_management/view_annual_calender">View Academic Calender</a>
                    </li>
                </ul>