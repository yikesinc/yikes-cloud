<?php
/**
 * Events widget
 *
 * @package YIKES Starter
 */

/**
 * Fetch upcoming events.
 *
 * If the existing HTML structure works for the project, then you don't need to set a return type.
 * If you need more custom HTML to structure your events data, set the $return_type to 'array' and create the HTML yourself.
 *
 * @param int    $number_of_events The number of events to fetch.
 * @param string $return_type Whether the content should be returned as an array of events data or as pre-formatted HTML.
 *
 * @return string array
 */
function yikes_easy_events_upcoming_events( $number_of_events = 2, $return_type = 'html' ) {

	$events_array = array();
	$content      = '';
	$events       = yks_ee_events_query_recent();
	$now          = strtotime( '-1 days' );
	$i            = 0;

	foreach ( $events as $event ) {
		if ( $now < $event['event_date'] ) {
			if ( $i < $number_of_events ) {

				// Get the meta, i.e. date(s), time, exceptions details.
				$start_time        = get_post_meta( $event['ID'], 'events_start_time', true );
				$end_time          = get_post_meta( $event['ID'], 'events_end_time', true );
				$all_day_event     = get_post_meta( $event['ID'], 'events_allday', true );
				$event_title       = get_the_title( $event['ID'] );
				$event_desc        = get_post_meta( $event['ID'], 'events_description', true );
				$event_date_string = gmdate( 'l, F j', $event['event_date'] );

				if ( get_post_meta( $event['ID'], 'events_recurring_event_yks', true ) === 'on' ) {

					// Exceptions logic for repeating events.

					// Get the exceptions meta.
					$event_exceptions = get_post_meta( $event['ID'], 'events_exemptions', true );

					// If we have exceptions data.
					if ( ! empty( $event_exceptions[ $event['event_date'] ] ) ) {
						$event_occurrence_exceptions = $event_exceptions[ $event['event_date'] ];
					} else {
						$event_occurrence_exceptions = array();
					}

					// Check if this event is skipped and if so let's jump to the next one.
					if ( '2' === isset( $event_occurrence_exceptions['skip'] ) && ! empty( $event_occurrence_exceptions['skip'] ) && (string) $event_occurrence_exceptions['skip'] ) {
						continue;
					}

					// For each possible exception variable, check if there's an exception set.

					// Title.
					if ( isset( $event_occurrence_exceptions['title'] ) && ! empty( $event_occurrence_exceptions['title'] ) ) {
						$event_title = $event_occurrence_exceptions['title'];
					}

					// Description.
					if ( isset( $event_occurrence_exceptions['description'] ) && ! empty( $event_occurrence_exceptions['description'] ) ) {
						$event_desc = $event_occurrence_exceptions['description'];
					}

					// All Day.
					if ( isset( $event_occurrence_exceptions['allday'] ) && ! empty( $event_occurrence_exceptions['allday'] ) ) {
						$all_day_event = $event_occurrence_exceptions['allday'];
					}

					// Start Time.
					if ( isset( $event_occurrence_exceptions['start_time'] ) && ! empty( $event_occurrence_exceptions['start_time'] ) ) {
						$start_time = $event_occurrence_exceptions['start_time'];
					}

					// End Time.
					if ( isset( $event_occurrence_exceptions['end_time'] ) && ! empty( $event_occurrence_exceptions['end_time'] ) ) {
						$end_time = $event_occurrence_exceptions['end_time'];
					}
				}

				// Create out event URL.
				$event_url = get_the_permalink( $event['ID'] ) . '?sd=' . $event['event_date'] . '&ed=' . $event['event_date'] . 'ad=' . $all_day_event;

				// Create our time string.
				$time_string = '';
				if ( '2' === (string) $all_day_event ) {
					$time_string = 'All day';
				} elseif ( ! empty( $start_time ) ) {
					$time_string = gmdate( 'g:i A', strtotime( $start_time ) );

					if ( ! empty( $end_time ) && $start_time !== $end_time ) {
						$time_string .= ' - ' . gmsdate( 'g:i A', strtotime( $end_time ) );
					}
				}

				if ( 'array' === $return_type ) {

					// Create an array of event attributes to return.
					$events_array[ $i ]['event_date']  = $event_date_string;
					$events_array[ $i ]['event_url']   = $event_url;
					$events_array[ $i ]['event_title'] = $event_title;
					$events_array[ $i ]['time_string'] = $time_string;
				} else {

					// Create our HTML.
					$content .= '<div class="yks_ee_events-list-item clearfix">';
					$content .= '<a class="upcoming-events-widget-url" href=' . $event_url . '>';
					$content .= '<h3 class="yks_ee_events-title">' . $event_title . '</h3>';
					$content .= '</a>';
					$content .= '<div class="yks_ee_events-list-item-meta">';
					$content .= '<h4 class="yks_ee_events-list-item-meta-date">' . $event_date_string . '</h4>';
					$content .= '<h4 class="yks_ee_events-list-item-meta-time">' . $time_string . '</h4>';
					$content .= '</div>';
					$content .= '<div class="yks_ee_events-list-item-content">' . apply_filters( 'the_content', $event_desc ) . '</div>';
					$content .= '</div>';
				}

				$i++;
			}
		}
	}

	if ( 'array' === $return_type ) {
		return $events_array;
	} else {
		return $content;
	}
}
