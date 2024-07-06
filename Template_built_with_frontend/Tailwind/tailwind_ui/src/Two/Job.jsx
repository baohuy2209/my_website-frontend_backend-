function Job(title, icon, bgcolor) {
  return (
    <div className="flex bg-$(bgcolor) items-center space-x-2 p-4 border rounded shadow">
      <svg
        className={`w-6 h-6 p-4`}
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 4v16m8-8H4"
        ></path>
      </svg>
      <p>Text 1</p>
    </div>
  );
}
export default Job;
