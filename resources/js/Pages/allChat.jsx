import { Link } from "@inertiajs/inertia-react";
import moment from "moment";
import React from "react";

export default function AllChat({ chats, user }) {
    console.log(chats);
    console.log(user);
    return (
        <div className="w-full flex">
            <div className="w-full lg:w-1/3 min-h-screen border-r border-white border-opacity-20">
                <div className="h-16 border-r border-white border-opacity-25 flex items-center justify-center">
                    <h1 className="font-bold">All Chats</h1>
                </div>
                <div className="">
                    {chats.map((chat) => (
                        <div
                            key={chat.id}
                            className="w-full hover:bg-white hover:bg-opacity-10 border border-white border-opacity-25 py-4"
                        >
                            <Link
                                href={`/message/${
                                    user.name === chat.sender.name
                                        ? chat.receiver.name
                                        : chat.sender.name
                                }`}
                                className="flex px-3 items-center justify-between gap-4"
                            >
                                <div className="flex gap-2">
                                    <img
                                        src={`/storage/${
                                            user.name === chat.sender.name
                                                ? chat.receiver.image
                                                : chat.sender.image
                                        }`}
                                        alt=""
                                        className="w-12 h-12 object-cover rounded-full"
                                    />
                                    <div>
                                        <h1 className="font-semibold text-base text-[#DCDEE0]">
                                            {user.name === chat.sender.name
                                                ? chat.receiver.name
                                                : chat.sender.name}
                                        </h1>
                                        <div className="flex gap-2 items-start">
                                            <div>
                                            <p className="text-[#E1E3E4] break-all">
                                                {chat.message}
                                            </p>
                                            <p className="text-[#E1E3E4] text-xs">
                                                {moment
                                                    .utc(chat.created_at)
                                                    .fromNow()}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {chat.read_at == null ? (
                                    <div>
                                        <svg
                                            width="16"
                                            height="16"
                                            viewBox="0 0 30 30"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <circle
                                                cx="15"
                                                cy="15"
                                                r="15"
                                                fill="#2B7BC4"
                                            />
                                        </svg>
                                    </div>
                                ) : (
                                    "terbaca"
                                )}
                            </Link>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
