<?php
	/****
		*	File: geoloc.php
		*	Descrizione: Configurazione geolocalizzazione
		*
		*	Author: D4ng3R <mich.loris@gmail.com>

		    This file is part of :PooF.

		    :PooF is free software: you can redistribute it and/or modify
		    it under the terms of the GNU General Public License as published by
		    the Free Software Foundation, either version 3 of the License, or
		    (at your option) any later version.

		    :PooF is distributed in the hope that it will be useful,
		    but WITHOUT ANY WARRANTY; without even the implied warranty of
		    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		    GNU General Public License for more details.

		    You should have received a copy of the GNU General Public License
		    along with :PooF.  If not, see <http://www.gnu.org/licenses/>.
	*****/	

	DEFINE('_GEO_IP_ENABLE', true);
	DEFINE('_GEO_IP_TO_COUNTRY_TABLE', "geo_ip");
	$GLOBALS["_configTable"]['_GEO_ENABLE'] = 0;		// Abilizazione geolocalizzazione
	$GLOBALS["_configTable"]['_GEO_IP_REMOTE'] = 0; 	// Ricava ip da whatismyip.com ( utile per prove locali )
	$GLOBALS["_configTable"]['_GEO_GLOB_NAME'] = "geoloc"; 	// Nome del globalobject della geolocalizzazione ( deve essere conforme a quanto specificato in config.php)
	
	/* 	
	#		Tabella per la traduzione da IP a COUNTRY CODE
	#
	# IP FROM & : Numerical representation of IP address.
	# IP TO       Example: (from Right to Left)
	#             1.2.3.4 = 4 + (3 * 256) + (2 * 256 * 256) + (1 * 256 * 256 * 256)
	#             is 4 + 768 + 13,1072 + 16,777,216 = 16,909,060
	#
	# REGISTRY  : apcnic, arin, lacnic, ripencc and afrinic
	#             Also included as of April 22, 2005 are the IANA IETF Reserved
	#             address numbers. These are important since any source claiming
	#             to be from one of these IPs must be spoofed.
	#
	# ASSIGNED  : The date this IP or block was assigned. (In Epoch seconds)
	#             NOTE: Where the allocation or assignment has been transferred from
	#                   one registry to another, the date represents the date of first
	#                   assignment or allocation as received in from the original RIR.
	#                   It is noted that where records do not show a date of first
	#                   assignment, the date is given as "0".
	#
	# CTRY      : 2 character international country code
	#             NOTE: ISO 3166 2-letter code of the organisation to which the
	#             allocation or assignment was made, and the enumerated variances of:
	#                  AP - non-specific Asia-Pacific location
	#                  CS - Serbia and Montenegro
	#                  YU - Serbia and Montenegro (Formally Yugoslavia) (Being phased out)
	#                  EU - non-specific European Union location
	#                  FX - France, Metropolitan
	#                  PS - Palestinian Territory, Occupied
	#                  UK - United Kingdom (standard says GB)
	#                * ZZ - IETF RESERVED address space.
	*/

	if(_GEO_IP_ENABLE)
		$GLOBALS["_DB_STRUCT"][_GEO_IP_TO_COUNTRY_TABLE] =  array(
				'IP_FROM' => 'int(10) DEFAULT NULL',
		  		'IP_TO' => 'int(10) DEFAULT NULL',
		 		'REGISTRY' => 'varchar(7) DEFAULT NULL',
		  		'ASSIGNED' => 'int(10) DEFAULT NULL',
		  		'CTRY' => 'varchar(2) DEFAULT NULL',
		 	 	'CNTRY' => 'varchar(3) DEFAULT NULL',
		  		'COUNTRY' => 'varchar(37) DEFAULT NULL'									
			);
?>
