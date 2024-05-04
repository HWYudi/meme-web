import { Link } from "@inertiajs/inertia-react";
import React from "react";

export default function AllChat({ chats ,user }) {
    console.log(chats);
    console.log(user);
    return (
        <div className="w-full flex">
            <div className="w-full lg:w-1/4 min-h-screen border-r border-white border-opacity-20">
            <div className="h-16 border-r border-white border-opacity-25 flex items-center justify-center">
                <h1 className="font-bold">All Chats</h1>
            </div>
            <div className="">
                {chats.map((chat) => (
                    <div key={chat.id} className="w-full hover:bg-white hover:bg-opacity-10 border border-white border-opacity-25 py-4">
                        <Link href={`/message/${user.name === chat.sender.name ? chat.receiver.name : chat.sender.name }`} className="flex items-center gap-4">
                            <img
                                src={`/storage/${user.name === chat.sender.name ? chat.receiver.image : chat.sender.image}`}
                                alt=""
                                className="w-12 h-12 object-cover rounded-full"
                            />
                            <div>
                                <h1 className="font-semibold text-base text-[#DCDEE0]">
                                    {user.name === chat.sender.name ? chat.receiver.name : chat.sender.name}
                                </h1>
                                <p className="text-[#E1E3E4]  text-sm">
                                    {chat.message}
                                </p>
                            </div>
                        </Link>
                    </div>
                ))}
            </div>
            </div>
        </div>
    );
}
