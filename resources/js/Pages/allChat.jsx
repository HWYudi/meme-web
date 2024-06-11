import React from "react";

export default function allChat() {
    return (
        <div className="fixed inset-0 justify-center items-start flex pt-40">
            <div className="flex items-center gap-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    fill="currentColor"
                    class="bi bi-exclamation-diamond-fill"
                    viewBox="0 0 16 16"
                >
                    <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <h1 className="text-1xl lg:text-3xl font-semibold">
                    Fitur Ini Belum Tersedia
                </h1>
            </div>
        </div>
    );
}

// import { Link } from "@inertiajs/inertia-react";
// import moment from "moment";
// import React from "react";

// export default function AllChat({ chats, user }) {
//     console.log(chats);
//     console.log(user);
//     return (
//         <div className="w-full flex">
//             <div className="w-full lg:w-1/3 min-h-screen border-r border-white border-opacity-20">
//                 <div className="h-16 border-r border-white border-opacity-25 flex items-center justify-center">
//                     <h1 className="font-bold">All Chats</h1>
//                 </div>
//                 <div className="">
//                     {chats.map((chat) => (
//                         <div
//                             key={chat.id}
//                             className="w-full hover:bg-white hover:bg-opacity-10 border border-white border-opacity-25 py-4"
//                         >
//                             <Link
//                                 href={`/message/${
//                                     user.name === chat.sender.name
//                                         ? chat.receiver.name
//                                         : chat.sender.name
//                                 }`}
//                                 className="flex px-3 items-center justify-between gap-4"
//                             >
//                                 <div className="flex gap-2">
//                                     <img
//                                         src={`/storage/${
//                                             user.name === chat.sender.name
//                                                 ? chat.receiver.image
//                                                 : chat.sender.image
//                                         }`}
//                                         alt=""
//                                         className="w-12 h-12 object-cover rounded-full"
//                                     />
//                                     <div>
//                                         <h1 className="font-semibold text-base text-[#DCDEE0]">
//                                             {user.name === chat.sender.name
//                                                 ? chat.receiver.name
//                                                 : chat.sender.name}
//                                         </h1>
//                                         <div className="flex gap-2 items-start">
//                                             <div>
//                                             <p className="text-[#E1E3E4] break-all">
//                                                 {chat.message}
//                                             </p>
//                                             <p className="text-[#E1E3E4] text-xs">
//                                                 {moment
//                                                     .utc(chat.created_at)
//                                                     .fromNow()}
//                                             </p>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                                 {chat.read_at == null ? (
//                                     <div>
//                                         <svg
//                                             width="16"
//                                             height="16"
//                                             viewBox="0 0 30 30"
//                                             fill="none"
//                                             xmlns="http://www.w3.org/2000/svg"
//                                         >
//                                             <circle
//                                                 cx="15"
//                                                 cy="15"
//                                                 r="15"
//                                                 fill="#2B7BC4"
//                                             />
//                                         </svg>
//                                     </div>
//                                 ) : (
//                                     "terbaca"
//                                 )}
//                             </Link>
//                         </div>
//                     ))}
//                 </div>
//             </div>
//         </div>
//     );
// }
