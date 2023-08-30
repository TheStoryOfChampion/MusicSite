let darkMode = localStorage.getItem("darkMode");
const darkModeSwitch = document.querySelector("#themeswitch");
consol.log(darkMode);

const enableDarkMode = () => {
    document.body.classList.add("darkMode");
    document.body.classList.toggle("dark");
    localStorage.setItem("darkMode", "enabled");
};

const disableDarkMode = () => {
    document.body.classList.remove("darkMode");
    document.body.classList.toggle("switch");
    localStorage.setItem("darkMode", "disabled");
};

if(darkMode === "enabled")
    {
        enableDarkMode();
    }
else if(darkMode === "disabled")
    {
        disableDarkMode();
    }

darkModeSwitch.addEventListener("click", () => {
    darkMode = localStorage.getItem("darkMode");
  if(darkMode !== "endabled")
      {
          enableDarkMode();
          console.log(darkMode);
      }
    else if(darkMode === "enabled")
        {
            disableDarkMode();
            console.log(darkMode);
        }
});