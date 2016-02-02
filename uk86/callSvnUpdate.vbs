Set ws=wscript.createobject("wscript.shell")
dim bat
bat="cmd.exe /c svnUpdate.bat"
do
ws.run bat,0
wscript.sleep 15000
loop