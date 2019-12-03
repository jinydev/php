# Exceptions allowed in __toString rfc
Previously, exceptions could not be thrown in __toString. They were prohibited because of a workaround for some old core error handling mechanisms, but Nikita pointed out that this "solution" didn't actually solve the problem it tried to address.

This behaviour is now changed, and exceptions can be thrown from __toString.
