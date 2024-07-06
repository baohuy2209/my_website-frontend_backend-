import "../App.css";
function UserProfile() {
  return (
    <div className="w-[45rem] bg-white rounded-lg p-12 flex gap-x-4">
      <img
        src="https://scontent.fsgn5-12.fna.fbcdn.net/v/t39.30808-1/437601698_953934019555106_8887508135372328413_n.jpg?stp=c0.0.200.200a_dst-jpg_p200x200&_nc_cat=103&ccb=1-7&_nc_sid=0ecb9b&_nc_eui2=AeFXYesolZ7drTceGzPjOB5p5p-hof30ePPmn6Gh_fR48z4kOvqj5G0PzJdzfYlRcN585flfV-jKtbtnK9yvhr11&_nc_ohc=vg_5EWRdF6gQ7kNvgG2tU-M&_nc_ht=scontent.fsgn5-12.fna&gid=AZycSi80eGwHw9ZEulcbvUi&oh=00_AYDYcB011W3tJFb-UMUc4HVe9p3pk7FFW7vNEnETg3--wA&oe=668B09BC"
        className="w-32 self-start rounded-full border-[11px] border-[#E6EFFA]"
        alt=""
      ></img>
      <div className="space-y-7 text-[#1C2862]">
        <div>
          <h1 className="text-3xl font-bold font-popi">David Grant</h1>
          <h2>3D Artist</h2>
        </div>
        <div className="space-y-4">
          <p className="flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="size-6 inline-block mr-2"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
              />
            </svg>
            4.7 Rating
          </p>
          <p>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="size-6 inline-block mr-2"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"
              />
            </svg>
            4,447 Reviews
          </p>
          <p>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="size-6 inline-block mr-2"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
              />
            </svg>
            476 Students
          </p>
        </div>
        <p className="text-lg">
          David Grant has been making video games for a living for more than 14
          years as Designer, Producer, Creative Director, and Executive
          Producer, creating games for console, mobile, PC and facebook.
        </p>
        <button className=" rounded-md p-2 border-2 border-[#c4cadf]">
          Show more
        </button>
      </div>
    </div>
  );
}
export default UserProfile;
