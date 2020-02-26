# import ldap
# connect = ldap.initialize('ldap://ldap-consultation.inra.fr:636',bytes_mode=False)
# connect.set_option(ldap.OPT_REFERRALS, 0)
# connect.simple_bind_s('hqnguyen', 'Cybershot19!')
# results = connect.search_s(u'ou=personnes,dc=inra,dc=fr', ldap.SCOPE_SUBTREE, u"(cn=hqnguyen)")
#print(results)

import ldap
import  WARNING

## first you must bind so we're doing a simple bind first
try:
    l = ldap.open("ldap://ldap-consultation.inra.fr:636")
    l.protocol_version = ldap.VERSION3
	# Pass in a valid username and password to get
	# privileged directory access.
	# If you leave them as empty strings or pass an invalid value
	# you will still bind to the server but with limited privileges.
    username = "uid=%s,ou=personnes,dc=inra,dc=fr" % hqnguyen
    password  = "Cybershot19!"

	# Any errors will throw an ldap.LDAPError exception
	# or related exception so you can ignore the result
    try :
        l.simple_bind_s(username, password)
        valid = True
    except  e:
