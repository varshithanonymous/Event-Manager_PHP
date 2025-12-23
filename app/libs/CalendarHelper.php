<?php

class CalendarHelper {
    public static function getGoogleLink($event) {
        $start = date('Ymd\THis\Z', strtotime($event['start_time']));
        $end = date('Ymd\THis\Z', strtotime($event['end_time'] ?? $event['start_time'] . ' +2 hours'));
        
        $params = [
            'action' => 'TEMPLATE',
            'text' => $event['title'],
            'dates' => "$start/$end",
            'details' => $event['description'] ?? '',
            'location' => $event['location_name'] ?? '',
            'trp' => 'false'
        ];
        
        return 'https://www.google.com/calendar/render?' . http_build_query($params);
    }

    public static function getICalLink($event) {
        // For iCal, we typically generate a .ics file, but for simplicity we can return a data URI or a route
        // Let's create a route in index.php for this later.
        return BASE_URL . "event/" . $event['id'] . "/ics";
    }
}
