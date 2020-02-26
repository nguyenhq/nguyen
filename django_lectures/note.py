s = 'global variable'
def func():
    print(locals())

print('It is global ', globals()['func'])
print(globals().keys())
